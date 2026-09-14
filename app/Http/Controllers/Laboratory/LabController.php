<?php

namespace App\Http\Controllers\Laboratory;

use App\Http\Controllers\Controller;
use App\Models\LabOrder;
use App\Models\LabResult;
use App\Models\LabTest;
use App\Models\MedicalRecord;
use App\Notifications\LabResultNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'role:admin|doctor|nurse|lab_technician']);
    }

    /**
     * Display Laboratory Dashboard, Orders, and Catalog.
     */
    public function index(Request $request)
    {
        $queryOrders = LabOrder::with(['medicalRecord.patient', 'medicalRecord.doctor', 'results.labTest']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $queryOrders->where(function ($q) use ($searchTerm) {
                $q->where('lab_order_id', 'LIKE', $searchTerm)
                    ->orWhereHas('medicalRecord.patient', function ($pq) use ($searchTerm) {
                        $pq->where('full_name', 'LIKE', $searchTerm)
                            ->orWhere('patient_code', 'LIKE', $searchTerm);
                    });
            });
        }

        if ($request->filled('status') && in_array($request->status, ['pending', 'completed'])) {
            $queryOrders->where('status', $request->status);
        }

        $labOrders = $queryOrders->orderBy('lab_order_id', 'desc')->paginate(10)->appends($request->query());

        $totalOrders = LabOrder::count();
        $pendingOrders = LabOrder::where('status', 'pending')->count();
        $completedOrders = LabOrder::where('status', 'completed')->count();
        $totalTests = LabTest::count();

        $labTests = LabTest::orderBy('test_name', 'asc')->get();
        $medicalRecords = MedicalRecord::with(['patient', 'doctor'])->orderBy('record_id', 'desc')->limit(50)->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('form.laboratory.partials.order_table', compact('labOrders'))->render(),
                'totalOrders' => $totalOrders,
                'pendingOrders' => $pendingOrders,
                'completedOrders' => $completedOrders,
            ]);
        }

        return view('form.laboratory.lab', compact(
            'labOrders',
            'labTests',
            'medicalRecords',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalTests'
        ));
    }

    /**
     * Store a new Lab Order for a Medical Record.
     */
    public function storeOrder(Request $request)
    {
        $request->validate([
            'record_id' => 'required|exists:medical_records,record_id',
            'order_date' => 'required|date',
            'test_ids' => 'required|array|min:1',
            'test_ids.*' => 'required|exists:lab_tests,test_id',
        ]);

        DB::beginTransaction();
        try {
            $order = LabOrder::create([
                'record_id' => $request->record_id,
                'order_date' => $request->order_date,
                'status' => 'pending',
            ]);

            foreach ($request->test_ids as $testId) {
                $test = LabTest::find($testId);
                LabResult::create([
                    'lab_order_id' => $order->lab_order_id,
                    'test_id' => $testId,
                    'result_value' => 'Pending',
                    'normal_range' => $test ? $test->normal_range : null,
                    'remark' => null,
                ]);
            }

            DB::commit();
            return redirect()->back()->with(['success' => 'ការកម្មង់ពិនិត្យមន្ទីរពិសោធន៍ត្រូវបានបង្កើតដោយជោគជ័យ']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'មានបញ្ហាក្នុងការបង្កើតការកម្មង់៖ ' . $e->getMessage()]);
        }
    }

    /**
     * Save/Update test results for a Lab Order.
     */
    public function storeResults(Request $request, $id)
    {
        $order = LabOrder::with('results')->find($id);
        if (!$order) {
            return redirect()->back()->with(['error' => 'រកមិនឃើញការកម្មង់ពិនិត្យនេះទេ']);
        }

        $request->validate([
            'results' => 'required|array',
            'results.*.result_id' => 'required|exists:lab_results,result_id',
            'results.*.result_value' => 'required|string|max:100',
            'results.*.normal_range' => 'nullable|string|max:100',
            'results.*.remark' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->results as $resData) {
                $result = LabResult::find($resData['result_id']);
                if ($result) {
                    $result->update([
                        'result_value' => $resData['result_value'],
                        'normal_range' => $resData['normal_range'] ?? $result->normal_range,
                        'remark' => $resData['remark'] ?? null,
                    ]);
                }
            }

            $order->update(['status' => 'completed']);

            DB::commit();

            // Notify the ordering doctor + admins + nurses that results are ready
            $order->loadMissing('medicalRecord.doctor', 'medicalRecord.patient');
            $doctorUser = optional($order->medicalRecord)->doctor;

            $recipients = NotifiesRoles::specificUserPlusRoles($doctorUser, ['admin', 'nurse']);

            if ($recipients->isNotEmpty()) {
                Notification::send($recipients, new LabResultNotification($order));
            }

            return redirect()->back()->with(['success' => 'លទ្ធផលពិនិត្យមន្ទីរពិសោធន៍ត្រូវបានរក្សាទុកដោយជោគជ័យ']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'មានបញ្ហាក្នុងការរក្សាទុកលទ្ធផល៖ ' . $e->getMessage()]);
        }
    }

    /**
     * Add new Lab Test item to catalog.
     */
    public function storeTest(Request $request)
    {
        $request->validate([
            'test_name' => 'required|string|max:100',
            'test_code' => 'nullable|string|max:50',
            'normal_range' => 'nullable|string|max:100',
            'unit' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        LabTest::create($request->only(['test_name', 'test_code', 'normal_range', 'unit', 'price']));
        return redirect()->back()->with(['success' => 'តេស្តពិសោធន៍ថ្មីត្រូវបានបន្ថែមដោយជោគជ័យ']);
    }

    /**
     * Update Lab Test catalog item.
     */
    public function updateTest(Request $request, $id)
    {
        $test = LabTest::findOrFail($id);
        $request->validate([
            'test_name' => 'required|string|max:100',
            'test_code' => 'nullable|string|max:50',
            'normal_range' => 'nullable|string|max:100',
            'unit' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        $test->update($request->only(['test_name', 'test_code', 'normal_range', 'unit', 'price']));
        return redirect()->back()->with(['success' => 'តេស្តពិសោធន៍ត្រូវបានកែប្រែដោយជោគជ័យ']);
    }

    /**
     * Delete Lab Test catalog item.
     */
    public function destroyTest($id)
    {
        $test = LabTest::findOrFail($id);
        $test->delete();
        return redirect()->back()->with(['success' => 'តេស្តពិសោធន៍ត្រូវបានលុបដោយជោគជ័យ']);
    }
    public function showResult($id)
    {
        $labResult = LabResult::with([
            'labOrder.patient',
        ])->find($id);

        if (!$labResult) {
            return redirect()
                ->route('lab.index')
                ->with('error', 'រកមិនឃើញលទ្ធផលពិនិត្យមន្ទីរពិសោធន៍ទេ');
        }

        return view('form.laboratory.result.show', compact('labResult'));
    }
}
