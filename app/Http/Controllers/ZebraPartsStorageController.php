<?php

namespace App\Http\Controllers;

use App\Http\Services\ZebraActionsStorageService;
use App\Http\Services\ZebraPartsStorageService;
use App\Models\ZebraActionsStorage;
use App\Models\ZebraPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZebraPartsStorageController extends Controller
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
        $parts = ZebraPartsStorage::with(['type', 'status', 'provider', 'zebraStorage'])->where('zebra_storage_id', $request->zebra_storage_id)
            ->get()
            ->sortByDesc('created_at')
            ->values()
            ->all();
        return response()->json($parts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = ZebraPartsStorage::create($request->part);
        $new_item = $item->with(['type', 'status', 'provider', 'zebraStorage'])->find($item->id);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        ZebraPartsStorage::find($id)->update($part);
        return response()->json(ZebraPartsStorage::with(['type', 'status', 'provider', 'zebraStorage'])->find($id));
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
        ZebraPartsStorage::destroy($id);
        return response($id);
    }
}
