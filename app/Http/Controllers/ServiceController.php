<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use PDF;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private const IMAGE_DESTINATION = 'storage/imgs/serviceImages/';

    public function index()
    {
        Paginator::useBootstrap();
        $services = auth()->user()->services()->paginate(20);
        $vehicles = auth()->user()->vehicles()->get();
        return view('pages.services.index', compact(['services', 'vehicles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.services.create', compact('user_vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \Illuminate\Http\Requests\ServiceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        auth()->user()->services()->create([
            'user_id'=>auth()->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'service_name'=>$request->service_name,
            'service_title'=>$request->service_title,
            'service_date'=>$request->service_date,
            'km_operatinghour'=>$request->km_operatinghour,
            'description'=>$request->description,
            'price'=>$request->price
        ]);

        return redirect(route('services.index'))->with('message', 'A szervizelés sikeresen rögzítve!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $this->abortUnless($service);
        return view('pages.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $this->abortUnless($service);
        $user_vehicles = auth()->user()->vehicles()->get();
        return view('pages.services.edit', compact(['user_vehicles', 'service']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \Illuminate\Http\Requests\ServiceRequest $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->abortUnless($service);

        $service->update([
            'user_id'=>auth()->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'service_name'=>$request->service_name,
            'service_title'=>$request->service_title,
            'service_date'=>$request->service_date,
            'km_operatinghour'=>$request->km_operatinghour,
            'description'=>$request->description,
            'price'=>$request->price
        ]);

        return redirect(route('services.index'))->with('message', 'A szervizelés sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->abortUnless($service);

        try {
            $images = $service->serviceImages();

            foreach ($service->serviceImages as $image){
                unlink(self::IMAGE_DESTINATION . $image->file_name);
                unlink('storage/imgs/serviceImages/thumbs' . $image->file_name);
            }

            $images->delete();
            $service->delete();

            return redirect()->back()->with('message', 'A szervizelés sikeresen törölve');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'A szervizelés törlése közbe hiba lépett fel. Hibaüzenet: ' . $exception);
        }
    }

    public function abortUnless($service){
        abort_unless(auth()->user()->owns($service), 403);
    }

    public function createPDF(Request $request)
    {
        $services = Service::where('vehicle_id', $request->vehicleID)->get();
        $vehicle = Vehicle::where('id', $request->vehicleID)->first();
        $data = [
            'services' => $services,
            'vehicle' => $vehicle
        ];

        $pdf = PDF::loadView('pages/services/pdf', $data)->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
