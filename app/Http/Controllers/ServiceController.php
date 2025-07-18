<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Service;
use App\Models\Status;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $vehicles = Vehicle::where('client_id', $user->id)->get();

        return view('client.services.schedule', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Store scheduled service.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'new_licence_plate' => 'nullable|required_without:vehicle_id|string',
            'new_make' => 'nullable|required_without:vehicle_id|string',
            'new_model' => 'nullable|required_without:vehicle_id|string',
            'new_year' => 'nullable|required_without:vehicle_id|date',
        ]);

        $vehicleId = $request->vehicle_id;

        if (!$vehicleId) {
            $vehicle = Vehicle::create([
                'client_id' => $user->id,
                'licence_plate' => $request->new_licence_plate,
                'make' => $request->new_make,
                'model' => $request->new_model,
                'year' => $request->new_year,
            ]);
            $vehicleId = $vehicle->id;
        }

        $statusId = Status::where('name', 'Na čekanju')->first()?->id;

        Service::create([
            'vehicle_id' => $vehicleId,
            'employee_id' => null,
            'admin_id' => null,
            'status_id' => $statusId,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('client.services.index')->with('success', 'Termin uspešno zakazan.');
    }

    /**
     * Show all services for this client.
     */
    public function client_index()
    {
        $user = Auth::user();

        $services = Service::whereHas('vehicle', function ($query) use ($user) {
            $query->where('client_id', $user->id);
        })->with('status', 'vehicle')->get();

        return view('client.services.index', [
            'services' => $services
        ]);
    }

    /**
     * Show invoice for a finished service.
     */
    public function invoice(Service $service)
    {
        $user = Auth::user();

        if ($service->vehicle->client_id !== $user->id) {
            abort(403);
        }

        $bill = Bill::where('service_id', $service->id)->first();

        return view('client.services.invoice', [
            'service' => $service,
            'bill' => $bill
        ]);
    }

    public function employee_index()
    {
        $user = Auth::user();

        $services = Service::with('vehicle', 'status', 'bills')
            ->where('employee_id', $user->id)
            ->get();

        return view('employee.services.index', compact('services'));
    }

    public function edit(Service $service)
    {
        $user = Auth::user();

        if ($service->employee_id !== $user->id) {
            abort(403);
        }

        $statuses = Status::all();
        $bill = $service->bills()->first();

        return view('employee.services.edit', compact('service', 'statuses', 'bill'));
    }

    public function updateStatus(Request $request, Service $service)
    {
        $user = Auth::user();

        if ($service->employee_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $service->status_id = $request->status_id;
        $service->save();

        return redirect()->back()->with('success', 'Status uspešno izmenjen.');
    }

    public function storeBill(Request $request, Service $service)
    {
        $user = Auth::user();

        if ($service->employee_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $bill = $service->bills()->first();

        if (!$bill) {
            $service->bills()->create([
                'price' => $request->price,
            ]);
        } else {
            $bill->update(['price' => $request->price]);
        }

        return redirect()->back()->with('success', 'Račun dodat.');
    }
}
