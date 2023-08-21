<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::select('id', 'name', 'email', 'contact_no', 'status', 'created_at')->where('role_id', 2)->get();
        return view('admin.customers.customersList', compact('customers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        try {
            $id = decrypt($id);
            $customer = User::findOrfail($id);
            if ($customer) {
                return view('admin.customers.editCustomer', compact('customer'));
            }
            return redirect()->back()->with("error", 'Requested customer doesn\'t exit!!');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Some error occured!!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        try {
            $id = decrypt($id);
            $customer = User::findOrFail($id);
            if ($customer) {
                $validated = $request->validated();
                $data =  $customer->update($validated);
                // dd($data);
                
                return redirect()->route('customer.index')->with('success', 'Customer details updated successfully.');
            }

            return redirect()->back()->with('error', 'Customer not found.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error occured while updating customer details.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $id = decrypt($id);
            $customer = User::findOrfail($id);
            if ($customer) {
                $delete = $customer->delete();
                if ($delete) {
                    return redirect()->back()->with("success", $customer->name . ' has been deleted successfully!!');
                }
                return redirect()->back()->with("error", 'Something went Wrong!!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Requested customer doesn\'t exit!!');
        }
    }

    public function deleteMultipleCustomers(Request $request)
    {
        try {
            $ids = $request->customer_ids;
            if (!$ids) {
                return redirect()->back()->with("error", 'No customer has been seleted to delete!!');
            }
            User::whereIn('id', $ids)->delete();
            return redirect()->back()->with("success", ' Selected customers records has been deleted successfully!!');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Requested customer doesn\'t exit!!');
        }
    }
}