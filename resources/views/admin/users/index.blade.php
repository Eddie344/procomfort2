@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Пользователи</h2>
    <users-component :auth_user = "{{ Auth::id() }}"></users-component>
@endsection
