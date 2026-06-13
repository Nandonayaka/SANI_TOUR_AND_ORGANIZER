<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule.tourPackage.tour'])
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $schedules = Schedule::with('tourPackage.tour')->get();
        return view('bookings.create', compact('users', 'schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'total_persons' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $schedule = Schedule::find($request->schedule_id);
        $validated['total_price'] = $schedule->tourPackage->price * $request->total_persons;

        Booking::create($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $users = User::all();
        $schedules = Schedule::with('tourPackage.tour')->get();
        return view('bookings.edit', compact('booking', 'users', 'schedules'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'total_persons' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $schedule = Schedule::find($request->schedule_id);
        $validated['total_price'] = $schedule->tourPackage->price * $request->total_persons;

        $booking->update($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
