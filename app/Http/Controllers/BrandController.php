<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        // dd($brands);

        return view('brand.brandList', [
            'brands' => $brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brand.createBrand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBrandRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = public_path('brands/logos');
            $uplaod = $file->move($path, $fileName);
            $validated['logo'] = $fileName;
        }
        $create = Brand::create($validated);
        if ($create) {
            Alert::success('Success', $validated['name'] . ' brand has been added successfully!')->showConfirmButton();
            return redirect()->route('brand.index');
        }
        Alert::error('Error', 'Something went wrong!')->showConfirmButton();
        return redirect()->route('brand.index');
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
                return view('brand.editBrand', ['brand' => $brand]);
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested Brand doesn\'t exit!!');
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
                return view('brand.editBrand', ['brand' => $brand]);
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested Brand doesn\'t exit!!');
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

                $success = $brand->fill($validated)->save();
                if ($success) {
                    Alert::success('Success', $validated['name'] . ' brand has been updated successfully!')->showConfirmButton();
                    return redirect()->route('brand.index');
                }
                Alert::error('Error', 'Something went wrong!')->showConfirmButton();
                return redirect()->route('brand.index');
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested Brand doesn\'t exit!!');
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
                $delete = $brand->delete();
                if ($delete) {
                    Alert::success('Success', $brand->name . ' brand has been deleted successfully!')->showConfirmButton();
                    return redirect()->route('brand.index');
                }
                Alert::error('Error', 'Something went wrong!')->showConfirmButton();
                return redirect()->route('brand.index');
            }
        } catch (\Throwable $th) {
            $request->session()->flash("message", 'Requested Brand doesn\'t exit!!');
            return redirect()->route('brand.index');
        }
    }
}