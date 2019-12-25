<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getAll()
    {
        $users = User::filter()
            ->get()
            ->sortByDesc('created_at')
            ->values()
            ->all();
        return response()->json($users);
    }

    public function get($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->user);
        $new_user = $user->find($user->id);
        return response()->json($new_user);
    }
    public function show($id)
    {
        return view('admin.users.show', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->user);
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response($id);
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return response($id);
    }
}
