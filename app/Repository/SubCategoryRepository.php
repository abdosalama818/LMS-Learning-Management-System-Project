<?php

namespace App\Repository;


use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubCategoryRepository
{
    // Profile repository methods would go here




    public function storeSubCategory($request)
    {
        SubCategory::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'category_id' => $request->input('category_id'),
        ]);
    }

    public function updateSubCategory($request, $id)
    {
        $subcategory = SubCategory::find($id);



        $subcategory->update([
           'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'category_id' => $request->input('category_id'),
        ]);
    }


    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
    }


}
