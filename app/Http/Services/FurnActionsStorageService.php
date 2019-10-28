<?php


namespace App\Http\Services;


use App\Models\FurnActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FurnActionsStorageService
{
    public static function createAction(Request $request)
    {
        $action = new FurnActionsStorage;
        $action -> furn_storage_id = $request->furn_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> count = $request->count;
        $action->save();
    }
}
