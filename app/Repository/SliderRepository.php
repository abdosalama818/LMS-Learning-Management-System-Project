<?php

namespace App\Repository;


use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderRepository
{
    // Profile repository methods would go here




    public function storeSlider($request)
    {

       
        $path = Storage::putFile('slider', $request->file('image'));
        Slider::create([
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'video_url' => $request->input('video_url'),
            'image' => $path,
        ]);
    }

    public function updateSlider($request, $id)
    {
        $Slider = Slider::find($id);
        $path = $Slider->image;

        if ($request->hasFile('image')) {
            if ($Slider->image && Storage::exists($Slider->image ? $Slider->image : "")) {
                Storage::delete($Slider->image);
            }
            $path =Storage::putFile('slider',$request->file('image'));
        }

        $Slider->update([
             'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'video_url' => $request->input('video_url'),
            'image' => $path,
        ]);
    }


    public function deleteSlider($id)
    {
        $Slider = Slider::find($id);
        if ($Slider->image && Storage::exists($Slider->image ? $Slider->image : "")) {
            Storage::delete($Slider->image);
        }
        $Slider->delete();
    }


}
