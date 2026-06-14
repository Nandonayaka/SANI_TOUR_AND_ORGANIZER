<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['schedule.tourPackage.tour'])
            ->latest()
            ->paginate(10);
        $schedules = Schedule::with('tourPackage.tour')->get();

        return view('bookings.index', compact('bookings', 'schedules'));
    }

    public function create()
    {
        $schedules = Schedule::with('tourPackage.tour')->get();
        return view('bookings.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'schedule_id' => 'required|exists:schedules,id',
            'total_persons' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);
        $validated['total_price'] = $schedule->tourPackage->price * $request->total_persons;

        Booking::create($validated);
        return redirect()->route('bookings.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit(Booking $booking)
    {
        $schedules = Schedule::with('tourPackage.tour')->get();
        return view('bookings.edit', compact('booking', 'schedules'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'schedule_id' => 'required|exists:schedules,id',
            'total_persons' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);
        $validated['total_price'] = $schedule->tourPackage->price * $request->total_persons;

        $booking->update($validated);
        return redirect()->route('bookings.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
