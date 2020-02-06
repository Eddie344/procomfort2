@extends('admin.layouts.app')

@section('content')
    <roll-storage-single-component id="{{ $id }}" user_id="{{ Auth::id()  }}"></roll-storage-single-component>
@endsection
