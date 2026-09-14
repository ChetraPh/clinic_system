<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Pharmacy\Medicine;
use App\Models\Pharmacy\MedicineBatch;
use App\Models\Pharmacy\MedicineStockMovement;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Notifications\PrescriptionNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'role:admin|pharmacist|doctor']);
    }

    /**
     * Display a listing of prescriptions.
     */
    public function index(Request $request)
    {
        $query = Prescription::with(['medicalRecord.patient', 'medicalRecord.doctor', 'items.medicine']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('medicalRecord.patient', function ($pq) use ($searchTerm) {
                    $pq->where('full_name', 'LIKE', $searchTerm)
                        ->orWhere('patient_code', 'LIKE', $searchTerm);
                })
                    ->orWhereHas('items.medicine', function ($mq) use ($searchTerm) {
                        $mq->where('medicine_name', 'LIKE', $searchTerm);
                    })
                    ->orWhere('prescription_id', 'LIKE', $searchTerm);
            });
        }

        $prescriptions = $query->orderBy('prescription_id', 'desc')->paginate(10)->appends($request->query());
        $totalPrescriptions = Prescription::count();
        $medicalRecords = MedicalRecord::with(['patient', 'doctor'])->orderBy('record_id', 'desc')->limit(50)->get();
        $medicines = Medicine::where('is_active', true)->orderBy('medicine_name', 'asc')->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('form.phamacy.partials.prescription_table', compact('prescriptions'))->render(),
                'total' => $totalPrescriptions,
            ]);
        }

        return view('form.phamacy.prescriptions', compact('prescriptions', 'totalPrescriptions', 'medicalRecords', 'medicines'));
    }


    /**
     * Store a newly created prescription in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'record_id' => 'required|exists:medical_records,record_id',
            'prescribed_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,medicine_id',
            'items.*.dosage' => 'required|string|max:100',
            'items.*.frequency' => 'required|string|max:50',
            'items.*.duration_days' => 'required|integer|min:1',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $prescription = Prescription::create([
                'record_id' => $request->record_id,
                'prescribed_date' => $request->prescribed_date,
            ]);

            foreach ($request->items as $item) {
                PrescriptionItem::create([
                    'prescription_id' => $prescription->prescription_id,
                    'medicine_id' => $item['medicine_id'],
                    'dosage' => $item['dosage'],
                    'frequency' => $item['frequency'],
                    'duration_days' => $item['duration_days'],
                    'quantity' => $item['quantity'],
                ]);
            }

            DB::commit();

            // Notify pharmacists (need to dispense) + admins
            $recipients = NotifiesRoles::usersForRoles(['admin', 'pharmacist']);

            if ($recipients->isNotEmpty()) {
                Notification::send($recipients, new PrescriptionNotification($prescription));
            }

            return redirect()->back()->with(['success' => 'វេជ្ជបញ្ជាត្រូវបានបង្កើតដោយជោគជ័យ (Prescription created successfully)']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'មានបញ្ហាក្នុងការបង្កើតវេជ្ជបញ្ជា៖ ' . $e->getMessage()]);
        }
    }

    /**
     * Dispense a prescription and deduct batch stock.
     */
    public function dispense(Request $request, $id)
    {
        $prescription = Prescription::with(['items.medicine'])->find($id);
        if (!$prescription) {
            return redirect()->back()->with(['error' => 'រកមិនឃើញវេជ្ជបញ្ជាទេ']);
        }

        DB::beginTransaction();
        try {
            foreach ($prescription->items as $item) {
                $qtyNeeded = $item->quantity;

                // Deduct from batches ordered by FIFO (expiring soonest first)
                $batches = MedicineBatch::where('medicine_id', $item->medicine_id)
                    ->where(function ($q) {
                        $q->where('quantity_remaining', '>', 0)
                            ->orWhere('remaining_quantity', '>', 0);
                    })
                    ->orderBy('expiry_date', 'asc')
                    ->get();

                foreach ($batches as $batch) {
                    if ($qtyNeeded <= 0)
                        break;

                    $available = $batch->quantity_remaining ?? $batch->remaining_quantity ?? 0;
                    $deduct = min($qtyNeeded, $available);

                    $batch->quantity_remaining = max(0, $available - $deduct);
                    $batch->remaining_quantity = max(0, $available - $deduct);
                    $batch->save();

                    // Record stock movement
                    MedicineStockMovement::create([
                        'batch_id' => $batch->batch_id,
                        'movement_type' => 'OUT',
                        'quantity' => $deduct,
                        'reference_type' => 'PRESCRIPTION',
                        'reference_id' => $prescription->prescription_id,
                        'movement_date' => now(),
                    ]);

                    $qtyNeeded -= $deduct;
                }
            }

            DB::commit();
            return redirect()->back()->with(['success' => 'បានចេញថ្នាំតាមវេជ្ជបញ្ជាដោយជោគជ័យ (Prescription dispensed successfully)']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'មានបញ្ហាក្នុងការចេញថ្នាំ៖ ' . $e->getMessage()]);
        }
    }
}
