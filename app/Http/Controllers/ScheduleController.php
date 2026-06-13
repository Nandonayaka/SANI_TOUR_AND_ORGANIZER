<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\TourPackage;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('tourPackage.tour')->latest()->paginate(10);
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $packages = TourPackage::with('tour')->get();
        return view('schedules.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Schedule::create($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $packages = TourPackage::with('tour')->get();
        return view('schedules.edit', compact('schedule', 'packages'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $schedule->update($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
