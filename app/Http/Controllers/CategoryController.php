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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->input('page', 1);
            $categories = Category::orderBy('id')->paginate(10, ['*'], 'page', $page);
            return view('category.categoriesList', compact('categories'));
        }

        // For initial load
        $categories = Category::orderBy('id')->paginate(10);
        return view('category.categoriesList', compact('categories'));
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

        if ($create) {
            $request->session()->flash("success", $validated['name'] . ' category has been added successfully!!');
            return redirect()->route('category.index');
        } else {
            $request->session()->flash("error", 'Something went Wrong!!');
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
            $categories = Category::select('id', 'parent_id', 'name')->get();
            if ($category) {
                return view('category.editcategory', compact('category', 'categories'));
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested category doesn\'t exit!!');
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
            $categories = Category::select('id', 'parent_id', 'name')->get();
            if ($category) {
                return view('category.editcategory', compact('category', 'categories'));
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $id = decrypt($id);
        try {
            $category = Category::findOrfail($id);
            if ($category) {
                $validated = $request->validated();
                if ($request->hasFile('thumbnail')) {
                    $file = $request->file('thumbnail');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '.' . $extension;
                    $path = public_path('categories/thumbnails');
                    $uplaod = $file->move($path, $fileName);
                    if ($category->thumbnail && file_exists($path . '/' . $category->thumbnail)) {
                        unlink($path . '/' . $category->thumbnail);
                    }
                    $validated['thumbnail'] = $fileName;
                } else {
                    $validated['thumbnail'] = $category->thumbnail;
                }

                $success = $category->fill($validated)->save();
                if ($success) {
                    $request->session()->flash("success", $validated['name'] . ' has been updated successfully!!');
                    return redirect()->route('category.index');
                }
                $request->session()->flash("error", 'something went wrong!!');
                return redirect()->route('category.index');
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
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
                $request->session()->flash("error", 'Something went Wrong!!');
                return redirect()->route('category.index');
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
    }

    /**
     * Delete multiple records from storage.
     */
    public function deleteMultiple(Request $request)
    {
        try {
            $ids = $request->ids;
            Category::whereIn('id', explode(",", $ids))->delete();
            $request->session()->flash("success", ' selected categories has been deleted successfully!!');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested category doesn\'t exit!!');
            return redirect()->route('category.index');
        }
    }
}