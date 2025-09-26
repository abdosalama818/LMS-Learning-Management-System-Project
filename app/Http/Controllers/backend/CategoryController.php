<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{


    public $categorServices;
    public function __construct(CategoryServices $categorServices)
    {
        $this->categorServices = $categorServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_categories = Category::all();
        return view('backend.admin.category.index')->with(compact('all_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        try{
            $this->categorServices->storeCategory($request);
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $category = Category::find($id);
        return view('backend.admin.category.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $category = Category::find($id);
         try{
            $this->categorServices->updateCategory($request, $id);
            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
            }catch(\Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->categorServices->deleteCategory($id);
            return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Something went wrong.');
            }   
    }
}
