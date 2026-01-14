<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerformanceController extends Controller
{
    public function dashboard()
    {
        $performances = Performance::with(['venue','ticketTypes'])->latest()->take(6)->get();
        return view('dashboard', compact('performances'));
    }

    public function index(Request $request)
    {
        $query = Performance::with(['venue','ticketTypes']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")       
                  ->orWhereDate('date', 'like', "%{$search}%")  
                  ->orWhereHas('venue', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%") 
                         ->orWhere('city', 'like', "%{$search}%");
                  });
            });
        }

        $performances = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.performances.index', compact('performances'));
    }

    public function create()
    {
        $venues = Venue::all(); 
        return view('admin.performances.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'ticket_types.*' => 'nullable|numeric|min:0',
            'venue_id' => 'required|exists:venues,id',
            'photo' => 'required|image|max:2048' 
        ]);

        $path = $request->file('photo')->store('posters', 'public');

        $performance = Performance::create([
            'title' => $request->title,
            'date' => $request->date,
            'venue_id' => $request->venue_id,
            'image_path' => $path
        ]);

        $types = [
            'standard' => 'Стандартен',
            'student' => 'Студент',
            'child' => 'Дете',
            'vip' => 'VIP'
        ];

        foreach ($types as $key => $name) {
            $price = $request->input("ticket_types.$key");
            if ($price !== null && $price !== '') {
                $performance->ticketTypes()->create([
                    'name' => $name,
                    'price' => $price
                ]);
            }
        }

        return redirect()->route('admin.performances.index')
            ->with('success', 'Постановката е добавена успешно!');
    }

    public function edit(Performance $performance)
    {
        $venues = Venue::all();
        return view('admin.performances.edit', compact('performance', 'venues'));
    }

    public function update(Request $request, Performance $performance)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'ticket_types.*' => 'nullable|numeric|min:0',
            'venue_id' => 'required|exists:venues,id',
            'photo' => 'nullable|image|max:2048' 
        ]);

        $data = $request->only(['title', 'date', 'venue_id']);

        if ($request->hasFile('photo')) {
            if ($performance->image_path) {
                Storage::disk('public')->delete($performance->image_path);
            }
            $data['image_path'] = $request->file('photo')->store('posters', 'public');
        }

        $performance->update($data);

        $types = [
            'standard' => 'Стандартен',
            'student' => 'Студент',
            'child' => 'Дете',
            'vip' => 'VIP'
        ];

        foreach ($types as $key => $name) {
            $price = $request->input("ticket_types.$key");
            if ($price !== null && $price !== '') {
                $performance->ticketTypes()->updateOrCreate(
                    ['name' => $name],
                    ['price' => $price, 'is_active' => true]
                );
            } else {
                $performance->ticketTypes()->updateOrCreate(
                    ['name' => $name],
                    ['is_active' => false]
                );
            }
        }

        return redirect()->route('admin.performances.index')
            ->with('success', 'Постановката е обновена!');
    }

    public function destroy(Performance $performance)
    {
        if ($performance->image_path) {
            Storage::disk('public')->delete($performance->image_path);
        }
        
        $performance->delete();

        return redirect()->route('admin.performances.index')
            ->with('success', 'Постановката е изтрита!');
    }
}