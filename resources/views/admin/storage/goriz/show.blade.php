@extends('admin.layouts.app')

@section('content')
    <goriz-storage-single-component id="{{ $id }}" user_id="{{ Auth::id()  }}"></goriz-storage-single-component>
@endsection
