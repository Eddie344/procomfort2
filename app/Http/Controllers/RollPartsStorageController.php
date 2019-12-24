<?php

namespace App\Http\Controllers;

use App\Http\Services\RollActionsStorageService;
use App\Http\Services\RollPartsStorageService;
use App\Models\RollActionsStorage;
use App\Models\RollPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollPartsStorageController extends Controller
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
        $parts = RollPartsStorage::with(['type', 'status', 'provider', 'rollStorage'])->where('roll_storage_id', $request->roll_storage_id)
            ->get()
            ->sortByDesc('created_at')
            ->values()
            ->all();
        return response()->json($parts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = RollPartsStorage::create($request->part);
        $new_item = $item->with(['type', 'status', 'provider', 'rollStorage'])->find($item->id);
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
        $part = $request->part;
        RollPartsStorage::find($id)->update($part);
        return response()->json(RollPartsStorage::with(['type', 'status', 'provider', 'rollStorage'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RollPartsStorage::destroy($id);
        return response($id);
    }
}
