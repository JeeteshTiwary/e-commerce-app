@extends('layouts.bootstrap')
@section('content')
    <div class="container">
        <div class="">
            <div class="mt-5 d-flex justify-content-between align-items-center col-md-6">
                <h2 class="h2"> Provide your details... </h2>
            </div>
            <hr>
            <form name="" action="{{ Route('user-info.store') }}" method="post" enctype="multipart/form-data">
                {{ method_field('POST') }}
                @csrf
                <div class="form-group col-md-6">
                    <label for="contact_no" class="font-weight-bold">contact_no</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ old('contact_no') }}"
                        placeholder="contact no here..">
                    <span class="text-danger"> {{ $errors->first('contact_no') }} </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="address" class="font-weight-bold">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address') }}" placeholder="your address here..">
                    <span class="text-danger"> {{ $errors->first('address') }} </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="profile_picture" class="font-weight-bold">Profile Picture</label> <br />
                    <input type="file" id="profile_picture" name="profile_picture" value="{{ old('profile_picture') }}">
                    <span class="text-danger"> {{ $errors->first('profile_picture') }} </span>
                </div>
                <div class="form-group form-check mx-3">
                    <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox" value="1" checked
                        required>
                    <label class="form-check-label" for="checkbox">Check me out</label>
                    <span class="text-danger"> {{ $errors->first('checkbox') }} </span>
                </div>
                <div class="d-flex justify-content-between align-items-center col-md-6">
                    <button type="submit" class="btn btn-outline-primary mx-3">Save</button>
                    <input type="reset" value="Reset Form" class="btn btn-outline-danger" />
                </div>
            </form>
        </div>
    </div>
@endsection
