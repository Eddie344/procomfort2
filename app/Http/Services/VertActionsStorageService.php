<?php


namespace App\Http\Services;


use App\Models\VertActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VertActionsStorageService
{
    public static function createAction(Request $request)
    {
        $action = new VertActionsStorage;
        $action -> vert_storage_id = $request->vert_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
    }
}
