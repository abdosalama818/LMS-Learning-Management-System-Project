<?php

namespace App\Services;

use App\Repository\AdminRepository;

class AdminServices
{

    public $AdminRepository;
    public function __construct(AdminRepository $AdminRepository)
    {
        $this->AdminRepository = $AdminRepository;
    }
    public function updateProfile($request)
    {
        return $this->AdminRepository->updateProfile($request);
    }
    public function updatePassword($request)
    {
        return $this->AdminRepository->updatePassword($request);
    }

}
