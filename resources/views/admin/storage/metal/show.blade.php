@extends('admin.layouts.app')

@section('content')
    <metal-storage-single-component id="{{ $id }}" user_id="{{ Auth::id()  }}"></metal-storage-single-component>
@endsection
