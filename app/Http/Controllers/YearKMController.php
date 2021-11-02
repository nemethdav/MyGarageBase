<?php

namespace App\Http\Controllers;

use App\Http\Requests\YearKMRequest;
use App\Models\Vehicle;
use App\Models\YearKM;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use PDF;

class YearKMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $yearKMs = auth()->user()->yearKMs()->orderby('year', 'ASC')->paginate(10);
        $vehicles = auth()->user()->vehicles()->get();
        return view('pages.yearKM.index', compact(['yearKMs', 'vehicles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.yearKM.create', compact('user_vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Requests\YearKMRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(YearKMRequest $request)
    {
        auth()->user()->yearKMs()->create([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'year' => $request->year,
            'start_km_operating_hour' => $request->start_km_operating_hour,
            'end_km_operating_hour' => $request->end_km_operating_hour,
            'year_km_operating_hour' => $request->year_km_operating_hour
        ]);

        return redirect(route('yearkm.index'))->with('message', 'Az óraállás sikeresen rögzítve');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\YearKM $yearkm
     * @return \Illuminate\Http\Response
     */
    public function show(YearKM $yearkm)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\YearKM $yearKM
     * @return \Illuminate\Http\Response
     */
    public function edit(YearKM $yearkm)
    {
        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.yearKM.edit', compact('yearkm', 'user_vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Requests\YearKMRequest $request
     * @param \App\Models\YearKM $yearKM
     * @return \Illuminate\Http\Response
     */
    public function update(YearKMRequest $request, YearKM $yearkm)
    {
        $this->abortUnless($yearkm);

        $yearkm->update([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'year' => $request->year,
            'start_km_operating_hour' => $request->start_km_operating_hour,
            'end_km_operating_hour' => $request->end_km_operating_hour,
            'year_km_operating_hour' => $request->year_km_operating_hour
        ]);

        return redirect(route('yearkm.index'))->with('message', 'A megtett táv sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\YearKM $yearkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(YearKM $yearkm)
    {
        $this->abortUnless($yearkm);
        $yearkm->delete();
        return redirect()->back()->with('message', 'A kiválasztott adat sikeresen törölve');
    }

    public function abortUnless($yearkm)
    {
        abort_unless(auth()->user()->owns($yearkm), 403);
    }

    public function createPDF(Request $request)
    {
        $yearKms = YearKM::where('vehicle_id', $request->vehicleID)->orderby('year', 'ASC')->get();
        $vehicle = Vehicle::where('id', $request->vehicleID)->first();
        $data = [
            'yearKms' => $yearKms,
            'vehicle' => $vehicle
        ];

        $pdf = PDF::loadView('pages/yearKM/pdf', $data)->setPaper('A4');

        return $pdf->stream();
    }
}
