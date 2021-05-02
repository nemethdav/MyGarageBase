<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleCreateRequest;
use App\Models\Refueling;
use Illuminate\Http\Request;

class RefuelingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refuelings = auth()->user()->refuelings()->paginate(10);
        return $refuelings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Requests\VehicleCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleCreateRequest $request)
    {
        auth()->user()->refuelings()->create([
            'vehicle_id'=>$request->vehicle_id,
            'user_id' => auth()->user()-id,
            'date_time'=>$request->date_time,
            'km_operating_hour'=>$request->km_operating_hour,
            'trip1'=>$request->trip1,
            'trip2'=>$request->trip2,
            'refueled_quantity'=>$request->refueled_quantity,
            'fuel_cost'=>$request->fuel_cost,
            'refuelling_cost'=>$request->refuelling_cost,
            'average_consumption'=>$request->average_consumption
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refueling  $refueling
     * @return \Illuminate\Http\Response
     */
    public function show(Refueling $refueling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refueling  $refueling
     * @return \Illuminate\Http\Response
     */
    public function edit(Refueling $refueling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Requests\VehicleCreateRequest  $request
     * @param  \App\Models\Refueling  $refueling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refueling $refueling)
    {
        $refueling->update([
            'vehicle_id'=>$request->vehicle_id,
            'user_id' => auth()->user()-id,
            'date_time'=>$request->date_time,
            'km_operating_hour'=>$request->km_operating_hour,
            'trip1'=>$request->trip1,
            'trip2'=>$request->trip2,
            'refueled_quantity'=>$request->refueled_quantity,
            'fuel_cost'=>$request->fuel_cost,
            'refuelling_cost'=>$request->refuelling_cost,
            'average_consumption'=>$request->average_consumption
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refueling  $refueling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refueling $refueling)
    {
        try {
            $refueling->delete();
            return redirect()->back()->with('message', 'A tankolás sikeresen törölve');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'A tankolás törlése közbe hiba lépett fel. Hibaüzenet: ' . $exception);
        }
    }
}
