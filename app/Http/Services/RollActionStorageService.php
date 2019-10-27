<?php


namespace App\Http\Services;


use App\Models\RollActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollActionStorageService
{
    public static function createAction(Request $request)
    {
        $action = new RollActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
    }
}
