<?php


namespace App\Http\Services;


use App\Models\ZebraActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZebraActionStorageService
{
    public static function createAction(Request $request)
    {
        $action = new ZebraActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = 2;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
    }
}
