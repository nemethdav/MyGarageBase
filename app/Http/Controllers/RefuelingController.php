<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefuelingCreateRequest;
use App\Models\Refueling;
use Illuminate\Pagination\Paginator;

class RefuelingController extends Controller
{

    private const IMAGE_DESTINATION = 'storage/imgs/refuellingImages/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $refuelings = auth()->user()->refuelings()->orderBy('date_time')->paginate(10);
        return view('pages.refuelings.index', compact('refuelings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_vehicles = auth()->user()->vehicles()->get();
//        return $user_vehicles;
        return view('pages.refuelings.create', compact('user_vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Requests\RefuelingCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefuelingCreateRequest $request)
    {
        $image_name = null;
        if (($file = $request->file('image')) != null) {
            $image_name = uniqid() . "." . $request->image->getClientOriginalExtension();
            //Upload file
            $move = $file->move(public_path(self::IMAGE_DESTINATION), $image_name);
        }

        auth()->user()->refuelings()->create([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => auth()->user()->id,
            'date_time' => $request->date_time,
            'km_operating_hour' => $request->km_operating_hour,
            'trip1' => $request->trip1,
            'trip2' => $request->trip2,
            'refueled_quantity' => $request->refueled_quantity,
            'discount' => $request->discount,
            'fuel_cost' => $request->fuel_cost,
            'refuelling_cost' => $request->refuelling_cost,
            'average_consumption' => $request->average_consumption,
            'fuel_type' => $request->fuel_type,
            'image' => $image_name
        ]);

        return redirect(route('refueling.index'))->with('message', 'A tankolás sikeresen rögzítve!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Refueling $refueling
     * @return \Illuminate\Http\Response
     */
    public function show(Refueling $refueling)
    {
        $this->abortUnless($refueling);

        return view('pages.refuelings.show', compact('refueling'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Refueling $refueling
     * @return \Illuminate\Http\Response
     */
    public function edit(Refueling $refueling)
    {
        $this->abortUnless($refueling);

        define('HTML_DATETIME_LOCAL', "Y-m-d\TH:i");
        $php_timestamp = strtotime($refueling->date_time);
        $html_datetime_string = date(HTML_DATETIME_LOCAL, $php_timestamp);

        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.refuelings.edit', compact(['refueling', 'user_vehicles', 'html_datetime_string']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Requests\RefuelingCreateRequest $request
     * @param \App\Models\Refueling $refueling
     * @return \Illuminate\Http\Response
     */
    public function update(RefuelingCreateRequest $request, Refueling $refueling)
    {
        $this->abortUnless($refueling);

        $imageName = $refueling->image;
        if (($file = $request->file('image')) != null) {
            $imageName = uniqid() . "." . $request->image->getClientOriginalExtension();
            //Upload file
            $move = $file->move(public_path(self::IMAGE_DESTINATION), $imageName);

            $oldImage = $refueling->image;
            if ($oldImage != null)
                unlink(self::IMAGE_DESTINATION . $oldImage);
        }

        $refueling->update([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => auth()->user()->id,
            'date_time' => $request->date_time,
            'km_operating_hour' => $request->km_operating_hour,
            'trip1' => $request->trip1,
            'trip2' => $request->trip2,
            'refueled_quantity' => $request->refueled_quantity,
            'discount' => $request->discount,
            'fuel_cost' => $request->fuel_cost,
            'refuelling_cost' => $request->refuelling_cost,
            'average_consumption' => $request->average_consumption,
            'fuel_type' => $request->fuel_type,
            'image' => $imageName
        ]);

        return redirect(route('refueling.index'))->with('message', 'A tankolás sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Refueling $refueling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refueling $refueling)
    {
        $this->abortUnless($refueling);

        try {
            $refueling->delete();
            return redirect()->back()->with('message', 'A tankolás sikeresen törölve');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'A tankolás törlése közbe hiba lépett fel. Hibaüzenet: ' . $exception);
        }
    }

    public function abortUnless($refueling){
        abort_unless(auth()->user()->owns($refueling), 403);
    }
}
