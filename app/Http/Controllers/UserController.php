<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Request;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->paginate(10);
        return view('admin.customers.index', compact('users'));
    }
    public function store()
    {
        User::create(Request::all());
        return redirect('admin/customers')->with('status', 'Пользователь успешно добавлен!');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.customers.show', compact('user'));
    }
}
