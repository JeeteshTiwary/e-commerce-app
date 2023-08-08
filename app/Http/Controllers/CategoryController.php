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
        $categories = Category::select('id','name','thumbnail','description','parent_id')->get();
        // dd($categories);
        return view('category.categoriesList',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategory = Category::select('id', 'name')->get();
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
        dd($create);

        if ($create) {
            $request->session()->flash("success", $validated['name'] . 'category has been added successfully!!');
            return redirect()->route('category.index');
        } else {
            $request->session()->flash("message", 'Something went Wrong!!');
            return redirect()->route('category.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        try {
            $id = decrypt($id);
            $category = Category::findOrfail($id);
            if ($category) {
                return view('category.editcategory', ['category' => $category]);
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        try {
            $id = decrypt($id);
            $category = Category::findOrfail($id);
            if ($category) {
                return view('category.editCategory', ['category' => $category]);
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
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
    public function destroy(string $id, Request $request)
    {
        try {
            $id = decrypt($id);
            $category = Category::findOrfail($id);
            if ($category) {
                $path = public_path('categories/thumbnails');
                if (file_exists(file_exists($path . '/' . $category->thumbnail))) {
                    unlink($path . '/' . $category->thumbnail);
                }
                $delete = $category->delete();
                if ($delete) {
                    $request->session()->flash("success", $category->name . ' category has been deleted successfully!!');
                    return redirect()->route('category.index');
                }
                $request->session()->flash("message", 'Something went Wrong!!');
                return redirect()->route('category.index');
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
    }
}