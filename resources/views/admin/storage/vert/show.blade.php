@extends('admin.layouts.app')

@section('content')
    <vert-storage-single-component id="{{ $id }}" user_id="{{ Auth::id()  }}"></vert-storage-single-component>
@endsection
