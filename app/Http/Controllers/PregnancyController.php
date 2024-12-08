<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PregnancyController extends Controller
{
    // Calculate Pregnancy details based on last period date.
    public function calculatePregnancy(Request $request) {
        
        $request->validate([
            'last_period' => 'required|date',
        ]);

        $lastPeriod = Carbon::parse($request->last_period);

        // Calculate the due date (40 weeks from LMP)
        $dueDate = $lastPeriod->copy()->addWeeks(40);

        $currentDate = Carbon::now();

        // Calculate the pregnancy stage in days
        $pregnancyStageInDays = $lastPeriod->diffInDays($currentDate);

        // Ensure that the pregnancy stage is not beyond 40 weeks or negative
        if ($pregnancyStageInDays < 0 || $pregnancyStageInDays > 280) { // 280 days = 40 weeks
            return redirect()->back()->withErrors(['last_period' => 'Invalid date: Pregnancy should be within 40 weeks.']);
        }
        // Convert days to weeks and days
        $pregnancyWeeks = intdiv($pregnancyStageInDays, 7);
        $pregnancyDays = $pregnancyStageInDays % 7;

        // Pass calculated values to the view
        return view('pregnancy-calendar', compact('dueDate', 'pregnancyWeeks', 'pregnancyDays'));
    }
}

