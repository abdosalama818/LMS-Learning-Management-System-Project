<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repository\SliderRepository;

class SliderServices
{
   public $SliderRepository;
    public function __construct(SliderRepository $SliderRepository)
    {
         $this->SliderRepository = $SliderRepository;
    }

    public function storeSlider( $request){
        return $this->SliderRepository->storeSlider($request);
    }

    public function updateSlider($request, $id){
        $Slider = $this->SliderRepository->updateSlider($request, $id);
        return $Slider;
    }

    public function deleteSlider($id){
        return $this->SliderRepository->deleteSlider($id);
    }




}
