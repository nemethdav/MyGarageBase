<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtherCostsRequest;
use App\Models\OtherCosts;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use PDF;

class OtherCostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $otherCosts = auth()->user()->otherCosts()->paginate(10);
        $vehicles = auth()->user()->vehicles()->get();
        return view('pages.otherCosts.index', compact(['otherCosts', 'vehicles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.otherCosts.create', compact('user_vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
//     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Requests\OtherCostsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtherCostsRequest $request)
    {
        auth()->user()->otherCosts()->create([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'title' =>$request->title,
            'description' => $request->description,
            'price' => $request->price,
            'date' => $request->date
        ]);

        return redirect(route('otherCosts.index'))->with('message', 'A költség sikeresen rögzítve!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\OtherCosts $otherCost
     * @return \Illuminate\Http\Response
     */
    public function show(OtherCosts $otherCost)
    {
        $this->abortUnless($otherCost);
        return view('pages.otherCosts.show', compact('otherCost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\OtherCosts $otherCost
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherCosts $otherCost)
    {
        $this->abortUnless($otherCost);

        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.otherCosts.edit', compact(['otherCost', 'user_vehicles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OtherCosts $otherCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherCosts $otherCost)
    {
        $this->abortUnless($otherCost);

        $otherCost->update([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'title' =>$request->title,
            'description' => $request->description,
            'price' => $request->price,
            'date' => $request->date
        ]);

        return redirect(route('otherCosts.index'))->with('message', 'A költség sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OtherCosts $otherCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherCosts $otherCost)
    {
        $this->abortUnless($otherCost);

        $otherCost->delete();
        return redirect()->back()->with('message', 'A kiadás sikeresen törölve!');
    }

    public function abortUnless($otherCost)
    {
        abort_unless(auth()->user()->owns($otherCost), 403);
    }

    public function createPDF(Request $request)
    {
        $otherCosts = OtherCosts::where('vehicle_id', $request->vehicleID)->get();
        $vehicle = Vehicle::where('id', $request->vehicleID)->first();
        $data = [
            'otherCosts' => $otherCosts,
            'vehicle' => $vehicle
        ];

        $pdf = PDF::loadView('pages/otherCosts/pdf', $data)->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
