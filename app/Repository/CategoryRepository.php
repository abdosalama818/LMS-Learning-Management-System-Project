<?php

namespace App\Repository;


use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRepository
{
    // Profile repository methods would go here




    public function storeCategory($request)
    {
        $path = Storage::putFile('category', $request->file('image'));
        Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'image' => $path,
        ]);
    }

    public function updateCategory($request, $id)
    {
        $category = Category::find($id);
        $path = $category->image;

        if ($request->hasFile('image')) {
            if ($category->image && Storage::exists($category->image)) {
                Storage::delete($category->image);
            }
            $path = $request->file('image')->store('category');
        }

        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'image' => $path,
        ]);
    }


    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category->image && Storage::exists($category->image)) {
            Storage::delete($category->image);
        }
        $category->delete();
    }


}
