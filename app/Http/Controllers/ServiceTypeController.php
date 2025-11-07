<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::latest()->get();
        return view('admin.service-types.index', compact('serviceTypes'));
    }

    public function customerIndex()
    {
        $serviceTypes = ServiceType::where('is_active', true)->get();
        return view('customer.services.index', compact('serviceTypes'));
    }

    public function create()
    {
        return view('admin.service-types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ServiceType::create($request->all());

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Jenis layanan berhasil ditambahkan.');
    }

    public function show(ServiceType $serviceType)
    {
        return view('admin.service-types.show', compact('serviceType'));
    }

    public function edit(ServiceType $serviceType)
    {
        return view('admin.service-types.edit', compact('serviceType'));
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $serviceType->update($request->all());

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Jenis layanan berhasil diperbarui.');
    }

    public function destroy(ServiceType $serviceType)
    {
        // Check if service type has bookings
        if ($serviceType->bookings()->count() > 0) {
            return redirect()->route('admin.service-types.index')
                ->with('error', 'Tidak dapat menghapus jenis layanan yang sudah memiliki booking.');
        }

        $serviceType->delete();

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Jenis layanan berhasil dihapus.');
    }

    public function toggleStatus(ServiceType $serviceType)
    {
        $serviceType->update([
            'is_active' => !$serviceType->is_active
        ]);

        $status = $serviceType->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->route('admin.service-types.index')
            ->with('success', "Jenis layanan berhasil {$status}.");
    }
}
