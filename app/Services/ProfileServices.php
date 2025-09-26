<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repository\ProfileRepository;

class ProfileServices
{
   public $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
         $this->profileRepository = $profileRepository;
    }

    public function profileUpdate( $request){
        return $this->profileRepository->profileUpdate($request);
    }


    public function updatePassword($request){
        return $this->profileRepository->updatePassword($request);
    }

}
