<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImages;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ServiceImagesController extends Controller
{
    private const IMAGE_DESTINATION = 'storage/imgs/serviceImages/';
    private const IMAGE_THUMB_DESTINATION = 'storage/imgs/serviceImages/thumbs/';

    public function viewServicePictures($id)
    {
        $service = Service::findOrFail($id);
        $this->abortUnlessImages($service->user_id);

        return view('pages.services.images.newServiceImages', compact('service'));
    }

    public function imageUpload(Request $request)
    {
        $file = $request->file('file');
        $filename = uniqid() . "." . $file->getClientOriginalName();

        //Képek mentése
        if (!file_exists('storage/imgs/serviceImages/'))
            mkdir('storage/imgs/serviceImages/', 0777, true);
        $file->move(public_path(self::IMAGE_DESTINATION), $filename);

        //Miniatűrök mentése
        if (!file_exists('storage/imgs/serviceImages/thumbs'))
            mkdir('storage/imgs/serviceImages/thumbs', 0777, true);
        $thumb = Image::make('storage/imgs/serviceImages/' . $filename)->resize(240, 160)->save('storage/imgs/serviceImages/thumbs/' . $filename, 50);

        //Adatbázis mentés
        $service = Service::findOrFail($request->service_id);
        $image = $service->serviceImages()->create([
            'user_id' => auth()->user()->id,
            'service_id' => $request->service_id,
            'file_name' => $filename
        ]);

        return $image;
    }

    public function deleteImage($id){
        $image = ServiceImages::findOrFail($id);

        unlink(self::IMAGE_DESTINATION . $image->file_name);
        unlink(self::IMAGE_THUMB_DESTINATION . $image->file_name);
        $image->delete();

        return redirect()->back()->with('message', 'A kép sikeresen törölve');
    }

    public function abortUnlessImages($user_id){
        abort_unless(auth()->user()->ownImage($user_id), 403);
    }
}
