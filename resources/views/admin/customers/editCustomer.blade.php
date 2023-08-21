@extends('admin.layouts.home')
@section('title', 'Update Customers Details')
@section('content')
<div class="container col-md-6">
    <h1>Edit Customer Details</h1>
    <form method="post" action="{{ route('customer.update', encrypt($customer->id)) }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" readonly required>
            <span class="text-danger"> {{ $errors->first('name') }} </span>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" readonly required>
            <span class="text-danger"> {{ $errors->first('email') }} </span>
        </div>

        <div class="mb-3">
            <label for="contact_no" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $customer->contact_no }}" readonly required>
            <span class="text-danger"> {{ $errors->first('contact_no') }} </span>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" readonly>{{ $customer->address }}</textarea>
            <span class="text-danger"> {{ $errors->first('address') }} </span>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $customer->status == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $customer->status == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            <span class="text-danger"> {{ $errors->first('status') }} </span>
        </div>

        <a href="{{route('customer.index')}}" class="btn btn-light"> Cancel </a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
