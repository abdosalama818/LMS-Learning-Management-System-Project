<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubCategoryServices;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{


    public $subCategorServices;
    public function __construct(SubCategoryServices $subCategorServices)
    {
        $this->subCategorServices = $subCategorServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_subcategories = SubCategory::all();
        return view('backend.admin.subcategory.index')->with(compact('all_subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_categories = Category::all();
        return view('backend.admin.subcategory.create')->with(compact('all_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $validated = $request->validated();
        try{
            $this->subCategorServices->storeSubCategory($request);

        return redirect()->route('admin.subcategory.index')->with('success', 'SubCategory created successfully.');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
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
  public function edit(string $id)
{
    $sub_category = SubCategory::findOrFail($id);
    $all_categories = Category::all();

    return view('backend.admin.subcategory.edit', compact('sub_category', 'all_categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, string $id)
    {
            $validated = $request->validated();
            $subcategory = SubCategory::find($id);
            try{
                $this->subCategorServices->updateSubCategory($request, $id);
            return redirect()->route('admin.subcategory.index')->with('success', 'SubCategory updated successfully.');

            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Something went wrong.');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            try{
                $this->subCategorServices->deleteSubCategory($id);
            return redirect()->route('admin.subcategory.index')->with('success', 'SubCategory deleted successfully.');

            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Something went wrong.');
            }
    }
}
