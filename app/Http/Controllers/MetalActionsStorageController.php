<?php

namespace App\Http\Controllers;

use App\Models\MetalActionsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetalActionsStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAll(Request $request)
    {
        $actions = MetalActionsStorage::with(['type', 'user', 'metalStorage'])
            ->filter()
            ->get()
            ->sortByDesc('created_at')
            ->values()
            ->all();
        return response()->json($actions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_action = $request->action;
        if(!$new_action['user_id']) $new_action['user_id'] = Auth::id();
        $item = MetalActionsStorage::create($new_action);
        $new_item = $item->with(['type', 'user', 'metalStorage'])->find($item->id);
        return response()->json($new_item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MetalActionsStorage::destroy($id);
        return response($id);
    }
}
