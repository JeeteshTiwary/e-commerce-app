@extends('admin.home')
@section('content')
    <div class="m-5 align-items-center">
        {{ 'Hello , Welcome on E-Commerce App' }}
    </div>
    {{ auth()->user() }}
@endsection
