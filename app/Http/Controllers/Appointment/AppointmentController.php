<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Notifications\AppointmentNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'role:admin|doctor|nurse']);
    }

    /**
     * Check if the doctor already has an appointment in the same hour.
     */
    protected function hasConflict($userId, $appointmentDate, $excludeId = null)
    {
        $date = Carbon::parse($appointmentDate);

        return Appointment::where('user_id', $userId)
            ->where('status', 'scheduled')
            ->whereDate('appointment_date', $date->toDateString())
            ->whereTime('appointment_date', $date->format('H:i:00'))
            ->when($excludeId, function ($query) use ($excludeId) {
                $query->where('appointment_id', '!=', $excludeId);
            })
            ->exists();
    }
    /**
     * Display appointments with search, filters and statistics.
     */
    public function index(Request $request)
    {
        $appointments = $this->getFilteredAppointments($request);

        $totalAppointments = Appointment::count();

        $scheduledCount = Appointment::where('status', 'scheduled')->count();

        $completedCount = Appointment::where('status', 'completed')->count();

        $cancelledCount = Appointment::where('status', 'cancelled')->count();

        $patients = Patient::orderBy('full_name', 'asc')->get();

        // Spatie roles
        $doctors = User::role('doctor')
            ->orderBy('name', 'asc')
            ->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view(
                    'form.appointment.partials.table',
                    compact('appointments')
                )->render(),

                'total' => $totalAppointments,
                'scheduled' => $scheduledCount,
                'completed' => $completedCount,
                'cancelled' => $cancelledCount,
            ]);
        }

        return view(
            'form.appointment.appointment',
            compact(
                'appointments',
                'totalAppointments',
                'scheduledCount',
                'completedCount',
                'cancelledCount',
                'patients',
                'doctors'
            )
        );
    }

    /**
     * Filter appointments.
     */
    protected function getFilteredAppointments(Request $request)
    {
        $query = Appointment::with([
            'patient',
            'doctor',
        ]);

        if ($request->filled('search')) {

            $searchTerm = '%' . trim($request->search) . '%';

            $query->where(function ($q) use ($searchTerm) {

                // Patient search
                $q->whereHas('patient', function ($pq) use ($searchTerm) {

                    $pq->where('full_name', 'LIKE', $searchTerm)
                        ->orWhere('patient_code', 'LIKE', $searchTerm)
                        ->orWhere('phone', 'LIKE', $searchTerm);

                })

                    // Doctor/User search
                    ->orWhereHas('doctor', function ($dq) use ($searchTerm) {

                        $dq->where('name', 'LIKE', $searchTerm)
                            ->orWhere('specialization', 'LIKE', $searchTerm)
                            ->orWhere('phone', 'LIKE', $searchTerm);

                    })

                    // Reason search
                    ->orWhere('reason', 'LIKE', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate(
                'appointment_date',
                $request->date
            );
        }

        return $query
            ->orderBy('appointment_date', 'desc')
            ->paginate(10)
            ->appends($request->query());
    }

    /**
     * Store appointment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => ['required', 'exists:patients,patient_id'],
            'user_id' => ['required', 'exists:users,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:now'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
            'reason' => ['nullable', 'string', 'max:255'],
        ], [
            'appointment_date.after_or_equal' => 'មិនអាចជ្រើសរើសកាលបរិច្ឆេទ ឬម៉ោងក្នុងអតីតកាលបានទេ សូមជ្រើសរើសពេលវេលាថ្ងៃនេះ ឬថ្ងៃខាងមុខ។',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->errors()->first());
        }

        $validated = $validator->validated();

        if ($this->hasConflict($validated['user_id'], $validated['appointment_date'])) {
            return redirect()->back()->withInput()->with(
                'error',
                'វេជ្ជបណ្ឌិតរូបនេះមានការណាត់ជួបផ្សេងទៀតនៅក្នុងម៉ោងដដែលនេះរួចហើយ សូមជ្រើសរើសម៉ោងផ្សេង។'
            );
        }

        $appointment = Appointment::create($validated);

        // Notify the assigned doctor AND everyone with the admin role
        $doctor = User::find($validated['user_id']);
        $recipients = NotifiesRoles::specificUserPlusRoles($doctor, ['admin']);

        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new AppointmentNotification($appointment, 'created'));
        }

        return redirect()->back()->with('success', 'ការណាត់ជួបត្រូវបានបង្កើតដោយជោគជ័យ');
    }

    /**
     * Show appointment details.
     */
    public function show($id)
    {
        $appointment = Appointment::with([
            'patient',
            'doctor',
        ])->find($id);

        if (!$appointment) {
            return redirect()
                ->route('appointment.index')
                ->with(
                    'error',
                    'រកមិនឃើញការណាត់ជួបទេ'
                );
        }

        return view(
            'form.appointment.show',
            compact('appointment')
        );
    }

    /**
     * Edit appointment.
     */
    public function edit($id)
    {
        $appointment = Appointment::with([
            'patient',
            'doctor',
        ])->find($id);

        if (!$appointment) {
            return response()->json([
                'error' => 'រកមិនឃើញការណាត់ជួបទេ',
            ], 404);
        }

        return response()->json([
            'appointment_id' => $appointment->appointment_id,

            'patient_id' => $appointment->patient_id,

            'user_id' => $appointment->user_id,

            'appointment_date' => $appointment->appointment_date
                ? $appointment->appointment_date->format('Y-m-d\TH:i')
                : '',

            'status' => $appointment->status,

            'reason' => $appointment->reason,
        ]);
    }

    /**
     * Update appointment.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'រកមិនឃើញការណាត់ជួបទេ');
        }

        $validator = Validator::make($request->all(), [
            'patient_id' => ['required', 'exists:patients,patient_id'],
            'user_id' => ['required', 'exists:users,id'],
            'appointment_date' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->errors()->first());
        }

        $validated = $validator->validated();

        if ($this->hasConflict($validated['user_id'], $validated['appointment_date'], $appointment->appointment_id)) {
            return redirect()->back()->withInput()->with(
                'error',
                'វេជ្ជបណ្ឌិតរូបនេះមានការណាត់ជួបផ្សេងទៀតនៅក្នុងម៉ោងដដែលនេះរួចហើយ សូមជ្រើសរើសម៉ោងផ្សេង។'
            );
        }

        $oldStatus = $appointment->status;

        $appointment->update($validated);

        // Notify the assigned doctor AND everyone with the admin role
        $doctor = User::find($validated['user_id']);
        $recipients = NotifiesRoles::specificUserPlusRoles($doctor, ['admin']);

        if ($recipients->isNotEmpty()) {
            $action = ($validated['status'] === 'cancelled' && $oldStatus !== 'cancelled')
                ? 'cancelled'
                : 'updated';

            Notification::send($recipients, new AppointmentNotification($appointment, $action));
        }

        return redirect()->back()->with('success', 'ការណាត់ជួបត្រូវបានកែប្រែដោយជោគជ័យ');
    }

    /**
     * Delete appointment.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'រកមិនឃើញការណាត់ជួបទេ'
                );
        }

        $appointment->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'ការណាត់ជួបត្រូវបានលុបដោយជោគជ័យ'
            );
    }
}
