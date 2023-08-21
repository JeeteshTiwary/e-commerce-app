<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::select('id', 'name', 'logo', 'status', 'description', 'url')->with('categories')->orderBy('id')->paginate(15);
        return view('admin.brand.brandList', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.brand.createBrand', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBrandRequest $request)
    {
        try {

            $validated = $request->validated();
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $path = public_path('brands/logos');
                $uplaod = $file->move($path, $fileName);
                $validated['logo'] = $fileName;
            }
            $categories = $validated['categories'];

            $brand = Brand::create($validated);

            $brand->categories()->attach($categories, ['created_at' => now(), 'updated_at' => now()]);

            if ($brand) {
                $request->session()->flash('Success', $validated['name'] . ' brand has been added successfully!');
                return redirect()->route('brand.index');
            }
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash("error", 'something went wrong!!');
            return redirect()->route('brand.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        try {
            $id = decrypt($id);
            $brand = Brand::findOrfail($id);
            if ($brand) {
                return view('admin.brand.editBrand', compact('brand'));
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested Brand doesn\'t exit!!');
            return redirect()->route('brand.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        try {
            $id = decrypt($id);
            $brand = Brand::findOrfail($id);

            if ($brand) {
                $categories = Category::all();
                return view('admin.brand.editBrand', compact('brand', 'categories'));
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested Brand doesn\'t exit!!');
            return redirect()->route('brand.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $id = decrypt($id);
        try {
            $brand = Brand::findOrfail($id);
            if ($brand) {
                $validated = $request->validated();
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '.' . $extension;
                    $path = public_path('brands/logos');
                    $uplaod = $file->move($path, $fileName);
                    if ($brand->logo && file_exists($path . '/' . $brand->logo)) {
                        unlink($path . '/' . $brand->logo);
                    }
                    $validated['logo'] = $fileName;
                }
                $categories = $validated['categories'];

                $brand->update($validated);

                $brand->categories()->sync($categories);
                if ($brand) {
                    $request->session()->flash("success", $validated['name'] . ' has been updated successfully!!');
                    return redirect()->route('brand.index');
                }
                $request->session()->flash("error", 'some error occured during update!!');
                return redirect()->route('brand.index');
            }
        } catch (\Throwable $th) {
            $request->session()->flash("error", 'Requested Brand doesn\'t exit!!');
            return redirect()->route('brand.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $id = decrypt($id);
            $brand = Brand::findOrfail($id);
            if ($brand) {
                $path = public_path('brands/logos');
                if (file_exists(file_exists($path . '/' . $brand->logo))) {
                    unlink($path . '/' . $brand->logo);
                }
                $brand->categories()->detach();
                $delete = $brand->delete();
                if ($delete) {
                    return redirect()->back()->with("success", $brand->name . ' has been deleted successfully!!');
                }
                return redirect()->back()->with("error", 'some error occured during delete!!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Requested Brand doesn\'t exit!!');
        }
    }

    public function deleteMultipleBrands(Request $request)
    {
        try {
            $ids = $request->brand_ids;
            if (!$ids) {
                return redirect()->back()->with("error", 'No brand has been seleted to delete!!');
            }
            Brand::whereIn('id', $ids)->delete();
            return redirect()->back()->with("success", ' Selected brands has been deleted successfully!!');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Requested brand doesn\'t exit!!');
        }
    }
}