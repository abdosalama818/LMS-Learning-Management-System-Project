<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repository\SubCategoryRepository ;

class SubCategoryServices
{
   public $SubCategoryRepository;
    public function __construct(SubCategoryRepository $SubCategoryRepository)
    {
         $this->SubCategoryRepository = $SubCategoryRepository;
    }

    public function storeSubCategory( $request){
        return $this->SubCategoryRepository->storeSubCategory($request);
    }

    public function updateSubCategory($request, $id){
        $category = $this->SubCategoryRepository->updateSubCategory($request, $id);
        return $category;
    }

    public function deleteSubCategory($id){
        return $this->SubCategoryRepository->deleteSubCategory($id);
    }




}
