<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;

use App\Models\Patient;
use App\Models\Pharmacy\Medicine;
use App\Models\Pharmacy\MedicineBatch;
use App\Models\Pharmacy\MedicineStockMovement;
use App\Models\Pharmacy\Sale;
use App\Models\Pharmacy\SaleItem;
use App\Models\Setting\GeneralSettings;
use App\Models\Setting\InvoiceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class PharmacySaleController extends Controller
{

    public function index()
    {
        return view('form.phamacy.sell_pharmact');
    }
    public function history(Request $request)
    {
        $sales = Sale::with('patient')
            ->orderByDesc('sale_date')
            ->limit(30)
            ->get()
            ->map(function ($sale) {
                return [
                    'sale_id' => $sale->sale_id,
                    'sale_date' => $sale->sale_date->format('d-M-Y h:i A'),
                    'patient_name' => $sale->patient->full_name ?? 'អតិថិជនចរណ៍',
                    'total_amount' => (float) $sale->total_amount,
                    'receipt_url' => route('pharmacy.sell.receipt', $sale->sale_id),
                ];
            });

        return response()->json(['data' => $sales]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'សូមចូលគណនីជាមុនសិន។'
            ], 422);
        }

        $userId = $user->id;

        $data = $request->validate([
            'patient_id' => 'nullable|exists:patients,patient_id',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,medicine_id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $sale = DB::transaction(function () use ($data, $userId) {
            $sale = Sale::create([
                'patient_id' => $data['patient_id'] ?? null,
                'user_id' => $userId,
                'sale_date' => now(),
                'total_amount' => 0,
                'status' => 'COMPLETED',
            ]);

            $total = 0;

            foreach ($data['items'] as $item) {
                $total += $this->sellOneMedicine(
                    $sale,
                    $item['medicine_id'],
                    $item['quantity']
                );
            }

            $sale->update([
                'total_amount' => $total
            ]);

            return $sale;
        });

        Cache::forget('pharmacy.dashboard_stats');

        return response()->json([
            'message' => 'លក់ជោគជ័យ',
            'sale_id' => $sale->sale_id,
            'total_amount' => $sale->total_amount,
            'receipt_url' => route('pharmacy.sell.receipt', $sale->sale_id),
        ]);
    }

    protected function sellOneMedicine(Sale $sale, int $medicineId, int $quantity): float
    {
        $medicine = Medicine::findOrFail($medicineId);
        $remainingToSell = $quantity;
        $subtotal = 0;

        $batches = MedicineBatch::where('medicine_id', $medicineId)
            ->where('remaining_quantity', '>', 0)
            ->orderBy('expiry_date', 'asc')
            ->lockForUpdate()
            ->get();

        foreach ($batches as $batch) {
            if ($remainingToSell <= 0) {
                break;
            }

            $takeFromThisBatch = min($batch->remaining_quantity, $remainingToSell);

            $batch->decrement('remaining_quantity', $takeFromThisBatch);

            $lineSubtotal = $takeFromThisBatch * $medicine->selling_price;
            $subtotal += $lineSubtotal;

            SaleItem::create([
                'sale_id' => $sale->sale_id,
                'medicine_id' => $medicineId,
                'batch_id' => $batch->batch_id,
                'quantity' => $takeFromThisBatch,
                'unit_price' => $medicine->selling_price,
                'subtotal' => $lineSubtotal,
            ]);

            MedicineStockMovement::create([
                'batch_id' => $batch->batch_id,
                'movement_type' => 'OUT',
                'quantity' => $takeFromThisBatch,
                'reference_type' => 'SALE',
                'reference_id' => $sale->sale_id,
                'movement_date' => now(),
            ]);

            $remainingToSell -= $takeFromThisBatch;
        }

        if ($remainingToSell > 0) {
            throw ValidationException::withMessages([
                'items' => "ស្តុកមិនគ្រប់គ្រាន់សម្រាប់ {$medicine->medicine_name} (ខ្វះ {$remainingToSell} គ្រាប់)",
            ]);
        }

        return $subtotal;
    }
    // PharmacySaleController.php
    public function receipt(Sale $sale)
    {
        $sale->load(['items.medicine', 'patient', 'user']);

        $general = GeneralSettings::first();
        $billing = InvoiceSetting::firstOrCreate(['id' => 1]);

        return view('form.phamacy.sale_receipt', compact('sale', 'general', 'billing'));
    }
    public function search(Request $request)
    {
        $term = $request->get('q', '');

        $medicines = Medicine::where('is_active', true)
            ->where('medicine_name', 'like', "%{$term}%")
            ->select('medicine_id', 'medicine_name', 'strength', 'selling_price', 'unit')
            ->selectSub(
                MedicineBatch::selectRaw('COALESCE(SUM(remaining_quantity), 0)')
                    ->whereColumn('medicine_batches.medicine_id', 'medicines.medicine_id'),
                'stock_total'
            )
            ->having('stock_total', '>', 0)
            ->limit(20)
            ->get();

        return response()->json($medicines);
    }
    public function patientSearch(Request $request)
    {
        $q = $request->get('q', '');

        $patients = Patient::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($query) use ($q) {
                    $query->where('patient_id', 'like', "%{$q}%")
                        ->orWhere('patient_code', 'like', "%{$q}%")
                        ->orWhere('full_name', 'like', "%{$q}%");
                });
            })
            ->orderBy('patient_id')
            ->limit(50)
            ->get([
                'patient_id',
                'patient_code',
                'full_name',
            ]);

        return response()->json($patients);
    }
}
