<?php

namespace App\Http\Controllers;

use App\Http\Services\GorizActionsStorageService;
use App\Http\Services\GorizPartsStorageService;
use App\Models\GorizActionsStorage;
use App\Models\GorizPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GorizPartsStorageController extends Controller
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
        $parts = GorizPartsStorage::with(['type', 'status', 'provider', 'gorizStorage'])->where('goriz_storage_id', $request->goriz_storage_id)->get();
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
        $item = GorizPartsStorage::create($request->part);
        $new_item = $item->with(['type', 'status', 'provider', 'gorizStorage'])->find($item->id);
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
        GorizPartsStorage::find($id)->update($part);
        return response()->json(GorizPartsStorage::with(['type', 'status', 'provider', 'gorizStorage'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GorizPartsStorage::destroy($id);
        return response($id);
    }
}
