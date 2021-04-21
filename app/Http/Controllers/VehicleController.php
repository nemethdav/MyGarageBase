<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Pagination\Paginator;

class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $vehicles = \auth()->user()->vehicles()->orderBy('id', 'ASC')->paginate(10);
//        return $vehicles;
        return view('pages.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * //     * @param \Illuminate\Http\Request $request
     * @param App\Http\Requests\VehicleCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleCreateRequest $request)
    {
        \auth()->user()->vehicles()->create([
            'user_id' => \auth()->user()->id,
            'vehicleNickName' => $request->vehicle["vehicleNickName"],
            'vehicle_type' => $request->vehicle["vehicle_type"],
            'vehicle_image' => $request->vehicle["vehicle_image"],
            'manufacturer' => $request->vehicle["manufacturer"],
            'type' => $request->vehicle["type"],
            'license_plate_number' => $request->vehicle["license_plate_number"],
            'year_of_manufacture' => $request->vehicle["year_of_manufacture"],
            'chassis_number' => $request->vehicle["chassis_number"],
            'motor_number' => $request->vehicle["motor_number"],
            'motor_code' => $request->vehicle["motor_code"],
            'cylinder_capacity' => $request->vehicle["cylinder_capacity"],
            'performance_kw' => $request->vehicle["performance_kw"],
            'performance_le' => $request->vehicle["performance_le"],
            'validity_of_technical_Examination' => $request->vehicle["validity_of_technical_Examination"]
        ]);

        return "Jármű elmentve";
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
//        $vehicleType = $vehicle->vehicleType()->vehicle_type;
        return view('pages.vehicles.show', compact(["vehicle"]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Vehicle $vehicles
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param App\Http\Requests\VehicleCreateRequest $request
     * @param \App\Models\Vehicle $vehicles
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleCreateRequest $request, Vehicle $vehicles)
//    public function update(Request $request, Vehicle $vehicles)
//    public function update(Request $request, $id)
    {

        if ($vehicles) { //Ha létrezik az adott id-jű jármű
            $vehicles->update([
                'user_id' => \auth()->user()->id,
                'vehicleNickName' => $request->vehicle["vehicleNickName"],
                'vehicle_type' => $request->vehicle["vehicle_type"],
                'vehicle_image' => $request->vehicle["vehicle_image"],
                'manufacturer' => $request->vehicle["manufacturer"],
                'type' => $request->vehicle["type"],
                'license_plate_number' => $request->vehicle["license_plate_number"],
                'year_of_manufacture' => $request->vehicle["year_of_manufacture"],
                'chassis_number' => $request->vehicle["chassis_number"],
                'motor_number' => $request->vehicle["motor_number"],
                'motor_code' => $request->vehicle["motor_code"],
                'cylinder_capacity' => $request->vehicle["cylinder_capacity"],
                'performance_kw' => $request->vehicle["performance_kw"],
                'performance_le' => $request->vehicle["performance_le"],
                'validity_of_technical_Examination' => $request->vehicle["validity_of_technical_Examination"]
            ]);
            return $vehicles;
        }

        return "A jármű nem található";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();
            return redirect()->back()->with('message', 'ToDo sikeresen törölve');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'A ToDo törlése közbe hiba lépett fel. Hibaüzenet: ' . $exception);
        }
    }
}
