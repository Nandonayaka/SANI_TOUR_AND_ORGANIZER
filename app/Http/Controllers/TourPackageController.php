<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Tour;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::with('tour')->latest()->paginate(10);
        $tours = Tour::all();
        return view('packages.index', compact('packages', 'tours'));
    }

    public function create()
    {
        $tours = Tour::all();
        return view('packages.create', compact('tours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        TourPackage::create($validated);
        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(TourPackage $package)
    {
        $tours = Tour::all();
        return view('packages.edit', compact('package', 'tours'));
    }

    public function update(Request $request, TourPackage $package)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $package->update($validated);
        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(TourPackage $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
