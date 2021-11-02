<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorwayVignetteCreateRequest;
use App\Models\MotorwayVignette;
use App\Models\Vehicle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use PDF;

class MotorwayVignetteController extends Controller
{

    private const IMAGE_DESTINATION = 'storage/imgs/motorwayVignettes/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $motorwayVignettes = auth()->user()->motorwayVignettes()->paginate(10);
        $vehicles = auth()->user()->vehicles()->get();
        return view('pages.motorwayVignettes.index', compact(['motorwayVignettes', 'vehicles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.motorwayVignettes.create', compact('user_vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
//     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Requests\MotorwayVignetteCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotorwayVignetteCreateRequest $request)
    {
        $image_name = null;
        if (($file = $request->file('image')) != null) {
            $image_name = uniqid() . "." . $request->image->getClientOriginalExtension();
            //Upload file
            $move = $file->move(public_path(self::IMAGE_DESTINATION), $image_name);
        }

        auth()->user()->motorwayVignettes()->create([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'category' => $request->category,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'date_of_purchase' => $request->date_of_purchase,
            'price' => $request->price,
            'image' => $image_name
        ]);

        return redirect(route('motorwayVignette.index'))->with('message', 'Az autópályamatrica sikeresen rögzítve!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MotorwayVignette $motorwayVignette
     * @return \Illuminate\Http\Response
     */
    public function show(MotorwayVignette $motorwayVignette)
    {
        $this->abortUnless($motorwayVignette);

        try {
            $days = $this->days($motorwayVignette);
            return view('pages.motorwayVignettes.show', compact(['motorwayVignette', 'days']));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Hiba a hátralévő napok meghatározásakor! Hiba:' . $exception->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MotorwayVignette $motorwayVignette
     * @return \Illuminate\Http\Response
     */
    public function edit(MotorwayVignette $motorwayVignette)
    {
        $this->abortUnless($motorwayVignette);

        define('HTML_DATETIME_LOCAL', "Y-m-d\TH:i");

        $php_timestamp = strtotime($motorwayVignette->start_date);
        $start_date = date(HTML_DATETIME_LOCAL, $php_timestamp);

        $php_timestamp = strtotime($motorwayVignette->end_date);
        $end_date = date(HTML_DATETIME_LOCAL, $php_timestamp);

        $php_timestamp = strtotime($motorwayVignette->date_of_purchase);
        $date_of_purchase = date(HTML_DATETIME_LOCAL, $php_timestamp);

        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.motorwayVignettes.edit', compact(['motorwayVignette', 'user_vehicles', 'start_date', 'end_date', 'date_of_purchase']));
    }

    /**
     * Update the specified resource in storage.
     *
//     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Requests\MotorwayVignetteCreateRequest $request
     * @param \App\Models\MotorwayVignette $motorwayVignette
     * @return \Illuminate\Http\Response
     */
    public function update(MotorwayVignetteCreateRequest $request, MotorwayVignette $motorwayVignette)
    {
        $this->abortUnless($motorwayVignette);

        $imageName = $motorwayVignette->image;
        if (($file = $request->file('image')) != null) {
            $imageName = uniqid() . "." . $request->image->getClientOriginalExtension();
            //Upload file
            $move = $file->move(public_path(self::IMAGE_DESTINATION), $imageName);

            $oldImage = $motorwayVignette->image;
            if ($oldImage != null)
                unlink(self::IMAGE_DESTINATION . $oldImage);
        }

        $motorwayVignette->update([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'category' => $request->category,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'date_of_purchase' => $request->date_of_purchase,
            'price' => $request->price,
            'image' => $imageName
        ]);

        return redirect(route('motorwayVignette.index'))->with('message', 'Az autópályamatrica sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MotorwayVignette $motorwayVignette
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotorwayVignette $motorwayVignette)
    {
        $this->abortUnless($motorwayVignette);

        try {
            $motorwayVignette->delete();

            $deleteImage = $motorwayVignette->image;
            if ($deleteImage != null)
                unlink(self::IMAGE_DESTINATION . $deleteImage);

            return redirect()->back()->with('message', 'A kiválasztott autópályamatrica sikeresen törölve!');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'A törlés közben hiba lépett fel. Hibaüzenet: ' . $exception);
        }
    }

    public function abortUnless($motorwayVignette){
        abort_unless(auth()->user()->owns($motorwayVignette), 403);
    }

    public function days(MotorwayVignette $motorwayVignette){
        $end_date = $motorwayVignette->end_date;
        $now = date("Y-m-d H:i:s");
        $datetime1 = new DateTime($end_date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        return $days;
    }

    public function createPDF(Request $request){
        $motorwayVignettes = MotorwayVignette::where('vehicle_id' , $request->vehicleID)->get();
        $vehicle = Vehicle::where('id', $request->vehicleID)->first();

        $data = [
            'motorwayVignettes' => $motorwayVignettes,
            'vehicle' => $vehicle,
        ];

        $pdf = PDF::loadView('pages/motorwayVignettes/pdf', $data)->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
