<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Services\SliderServices;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $sliderService;
    public function __construct(SliderServices $sliderService)
    {
        $this->sliderService = $sliderService;
    }
    public function index()
    {
        $slider = Slider::all();
        return view('backend.admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $validated = $request->validated();
        try{


            $this->sliderService->storeSlider($request);
      $notification = array(
                'message' => 'slider Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.slider.index')->with($notification);

     }catch(\Exception $e){
 $notification = array(
                'message' => 'some thing is worng ' . $e->getMessage(),
                'alert-type' => 'error'
            );
    return redirect()->back()->with($notification);
}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit( $id)
    {
        $slider = Slider::find($id);
        return view('backend.admin.slider.edit', compact('slider'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $validated = $request->validated();
          try{


            $this->sliderService->updateSlider($request,$id);
      $notification = array(
                'message' => 'slider updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.slider.index')->with($notification);

     }catch(\Exception $e){
 $notification = array(
                'message' => 'some thing is worng ' . $e->getMessage(),
                'alert-type' => 'error'
            );
    return redirect()->back()->with($notification);
}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
           try{


            $this->sliderService->deleteSlider($id);
      $notification = array(
                'message' => 'slider delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.slider.index')->with($notification);

     }catch(\Exception $e){
 $notification = array(
                'message' => 'some thing is worng ' . $e->getMessage(),
                'alert-type' => 'error'
            );
    return redirect()->back()->with($notification);
    }
}
}
