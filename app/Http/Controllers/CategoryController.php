<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\createCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.categoriesList');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategory = Category::where('parent_id' == 0);
        // dd($parentCategory);
        return view('category.createCategory', [
            'categories' => $parentCategory,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createCategoryRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = public_path('categories/thumbnails');
            $uplaod = $file->move($path, $fileName);
            $validated['thumbnail'] = $fileName;
        }
        $create = Category::create($validated);
        if ($create) {
            $request->session()->flash("success", $validated['name'] . 'category has been added successfully!!');
            return redirect()->route('category.index');
        }
        $request->session()->flash("message", 'Something went Wrong!!');
        return redirect()->route('category.index');

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
        return view('category.editCategory');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
