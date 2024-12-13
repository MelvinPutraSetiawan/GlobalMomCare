<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Hospital;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // Show appointments page with all the appointments.
    public function index() {
        $account = Account::where('id', Auth::id())->first();

        if ($account->role == "professional") {
            $schedules = Schedule::where('professional_id', Auth::id())->with('account', 'professional')->orderBy('date')->get();
            $professionals = Account::where('role', 'professional')->get();
            return view('appointments.index', compact('schedules', 'account', 'professionals'));
        }

        $schedules = Schedule::where('account_id', Auth::id())->with('account', 'professional')->orderByRaw("FIELD(status, 'Accepted', 'Pending', 'Denied')")->orderBy('date')->get();
        $professionals = Account::where('role', 'professional')->get();
        return view('appointments.index', compact('schedules', 'account', 'professionals'));
    }

    // Add new Appointments.
    public function addAppointments(Request $request) {
        $request->validate([
            'doctor' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:now',
        ]);

        Schedule::create([
            'account_id' => Auth::id(),
            'professional_id' => $request->doctor,
            'reason' => $request->reason,
            'status' => 'Pending',
            'date' => $request->appointment_date,
        ]);

        return redirect()->back();
    }

    // Delete Appointments.
    public function deleteAppointments($schedule_id) {

        $schedule = Schedule::find($schedule_id);

        if ($schedule) {
            $schedule->delete();
        }

        return redirect()->back();
    }

    // Professional can accept appointments.
    public function acceptAppointments($schedule_id) {
        $schedule = Schedule::find($schedule_id);

        $schedule->status = 'Accepted';
        $schedule->save();

        return redirect()->back();
    }

    // Professional can deny appointments.
    public function denyAppointments($schedule_id) {
        $schedule = Schedule::find($schedule_id);

        $schedule->status = 'Denied';
        $schedule->save();

        return redirect()->back();
    }
}
