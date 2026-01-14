<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $query = Venue::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        }

        $venues = $query->latest()->paginate(10)->withQueryString();

        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Venue::create($request->only(['name', 'city', 'address']));

        return redirect()->route('admin.venues.index')
            ->with('success', 'Мястото е добавено успешно!');
    }

    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $venue->update($request->only(['name', 'city', 'address']));

        return redirect()->route('admin.venues.index')
            ->with('success', 'Мястото е обновено!');
    }

    public function destroy(Venue $venue)
    {
        if ($venue->performances()->exists()) {
            return redirect()->route('admin.venues.index')
                ->with('error', 'Не може да изтриете място, което има постановки.');
        }

        $venue->delete();

        return redirect()->route('admin.venues.index')
            ->with('success', 'Мястото е изтрито!');
    }
}