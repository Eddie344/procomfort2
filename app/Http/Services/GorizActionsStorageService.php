<?php


namespace App\Http\Services;


use App\Models\GorizActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GorizActionsStorageService
{
    public static function createAction(Request $request)
    {
        $action = new GorizActionsStorage;
        $action -> goriz_storage_id = $request->goriz_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
    }
}
