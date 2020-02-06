@extends('admin.layouts.app')

@section('content')
    <furn-storage-single-component id="{{ $id }}" user_id="{{ Auth::id()  }}"></furn-storage-single-component>
@endsection
