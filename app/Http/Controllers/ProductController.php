<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Tag;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id', 'name')->with('brand', 'productDetails')->get();
        return view('admin.products.productList', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        $variations = Variation::select('id', 'name')->get();
        return view('admin.products.createProduct', compact('categories', 'brands', 'tags', 'variations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $path = public_path('products/thumbnails');
                $file->move($path, $fileName);
                $validated['thumbnail'] = $fileName;
            }

            $product = Product::create([
                'name' => $validated['name'],
                'updated_by' => auth()->user()->id,
            ]);

            $productDetail = $product->productDetails()->create([
                'description' => $validated['description'],
                'thumbnail' => $validated['thumbnail'],
                'status' => $validated['status'],
                'base_price' => $validated['base_price'],
                'sale_price' => $validated['sale_price'],
                'quantity_on_shelf' => $validated['quantity_on_shelf'],
                'quantity_in_warehouse' => $validated['quantity_in_warehouse'],
            ]);

            $product->tags()->attach($validated['tags'], ['created_at' => now(), 'updated_at' => now()]);
            $product->variations()->attach($validated['kt_ecommerce_add_product_options'], ['created_at' => now(), 'updated_at' => now()]);
            $product->brand()->attach([
                $validated['brand_id'] => [
                    'category_id' => $validated['category_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);

            $request->session()->flash("success", $validated['name'] . ' product has been added successfully!!');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            dd($th);
            $request->session()->flash("error", 'Something went Wrong!!');
            return redirect()->route('product.index');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        $variations = Variation::select('id', 'name')->get();
        return view('admin.products.editProduct', compact('categories', 'brands', 'tags', 'variations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        $variations = Variation::select('id', 'name')->get();
        return view('admin.products.editProduct', compact('categories', 'brands', 'tags', 'variations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            $id = decrypt($id);

            $product = Product::findOrFail($id);
            if ($product) {
                $validated = $request->validated();

                if ($request->hasFile('thumbnail')) {
                    $file = $request->file('thumbnail');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '.' . $extension;
                    $path = public_path('products/thumbnails');
                    $uplaod = $file->move($path, $fileName);
                    if ($product->thumbnail && file_exists($path . '/' . $product->thumbnail)) {
                        unlink($path . '/' . $product->thumbnail);
                    }
                    $validated['thumbnail'] = $fileName;
                } else {
                    $validated['thumbnail'] = $product->thumbnail;
                }

                $product->update([
                    'name' => $validated['name'],
                    'updated_by' => auth()->user()->id,
                ]);

                $productDetail = $product->productDetails()->update([
                    'description' => $validated['description'],
                    'thumbnail' => $validated['thumbnail'],
                    'status' => $validated['status'],
                    'base_price' => $validated['base_price'],
                    'sale_price' => $validated['sale_price'],
                    'quantity_on_shelf' => $validated['quantity_on_shelf'],
                    'quantity_in_warehouse' => $validated['quantity_in_warehouse'],
                ]);

                $product->tags()->sync($validated['tags'], ['updated_at' => now()]);

                $product->variations()->sync($validated['kt_ecommerce_add_product_options'], ['updated_at' => now()]);

                $product->brand()->sync([
                    $validated['brand_id'] => [
                        'category_id' => $validated['category_id'],
                        'updated_at' => now(),
                    ]
                ]);

                $request->session()->flash("success", $validated['name'] . ' product has been updated successfully!!');
                return redirect()->route('product.index');
            } else {
                $request->session()->flash("error", 'Requested product not found!!');
                return redirect()->route('product.index');
            }
        } catch (\Throwable $th) {
            dd($th);
            $request->session()->flash("error", 'Something went Wrong!!');
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        dd('delete');
        try {
            $id = decrypt($id);
            $product = Product::findOrfail($id);
            if ($product) {
                $path = public_path('products/thumbnail');
                if (file_exists(file_exists($path . '/' . $product->thumbnail))) {
                    unlink($path . '/' . $product->thumbnail);
                }
                $product->productDetails()->detach();
                $product->brand()->detach();
                $product->category()->detach();
                $product->tags()->detach();
                $product->variations()->detach();
                $delete = $product->delete();
                if ($delete) {
                    return redirect()->back()->with("success", $product->name . ' has been deleted successfully!!');
                    // return redirect()->route('product.index');
                }
                return redirect()->back()->with("error", 'some error occured during delete!!');
                // return redirect()->route('product.index');
            }
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Requested Product doesn\'t exit!!');
            // return redirect()->route('product.index');
        }
    }

    /**
     * Delete multiple records from storage.
     */
    public function deleteMultipleProducts(Request $request)
    {
        $delete = null;
        try {
            $ids = $request->product_ids;
            if (!$ids) {
                return redirect()->back()->with("error", 'No product has been seleted to delete!!');
            }
            foreach ($ids as $product) {
                $product->productDetails()->detach();
                dd($delete);
                $product->brand()->detach();
                $product->category()->detach();
                $product->tags()->detach();
                $product->variations()->detach();
                $delete = $product->delete();
            }
            // Category::whereIn('id', $ids)->delete();
            if ($delete) {
                return redirect()->back()->with("success", ' Selected products has been deleted successfully!!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Requested product doesn\'t exit!!');
        }
    }

}