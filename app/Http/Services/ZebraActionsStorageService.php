<?php


namespace App\Http\Services;


use App\Models\ZebraActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZebraActionsStorageService
{
    public static function createAction(Request $request)
    {
        $action = new ZebraActionsStorage;
        $action -> zebra_storage_id = $request->zebra_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
    }
}
