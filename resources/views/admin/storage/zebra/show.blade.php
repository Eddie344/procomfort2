@extends('admin.layouts.app')

@section('content')
    <zebra-storage-single-component id="{{ $id }}" user_id="{{ Auth::id()  }}"></zebra-storage-single-component>
@endsection
