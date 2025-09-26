<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repository\CategoryRepository;

class CategoryServices
{
   public $CategoryRepository;
    public function __construct(CategoryRepository $CategoryRepository)
    {
         $this->CategoryRepository = $CategoryRepository;
    }

    public function storeCategory( $request){
        return $this->CategoryRepository->storeCategory($request);
    }

    public function updateCategory($request, $id){
        $category = $this->CategoryRepository->updateCategory($request, $id);
        return $category;
    }

    public function deleteCategory($id){
        return $this->CategoryRepository->deleteCategory($id);
    }




}
