<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::latest()->get();
        return view('admin.technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('admin.technicians.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'specialization' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Technician::create($request->all());

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Teknisi berhasil ditambahkan.');
    }

    public function show(Technician $technician)
    {
        $bookings = $technician->bookings()->with(['user', 'serviceType'])->latest()->get();
        return view('admin.technicians.show', compact('technician', 'bookings'));
    }

    public function edit(Technician $technician)
    {
        return view('admin.technicians.edit', compact('technician'));
    }

    public function update(Request $request, Technician $technician)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'specialization' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $technician->update($request->all());

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Teknisi berhasil diperbarui.');
    }

    public function destroy(Technician $technician)
    {
        // Check if technician has bookings
        if ($technician->bookings()->count() > 0) {
            return redirect()->route('admin.technicians.index')
                ->with('error', 'Tidak dapat menghapus teknisi yang sudah memiliki booking.');
        }

        $technician->delete();

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Teknisi berhasil dihapus.');
    }

    public function toggleStatus(Technician $technician)
    {
        $technician->update([
            'is_active' => !$technician->is_active
        ]);

        $status = $technician->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->route('admin.technicians.index')
            ->with('success', "Teknisi berhasil {$status}.");
    }
}
