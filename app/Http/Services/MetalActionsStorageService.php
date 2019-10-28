<?php


namespace App\Http\Services;


use App\Models\MetalActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetalActionsStorageService
{
    public static function createAction(Request $request)
    {
        $action = new MetalActionsStorage;
        $action -> metal_storage_id = $request->metal_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
    }
}
