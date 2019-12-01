<?php

namespace App\Http\Controllers;

use App\Models\ZebraActionsStorage;
use App\Models\ZebraPartsStorage;
use App\Models\ZebraStorage;
use Illuminate\Http\Request;

class ZebraStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.storage.zebra.index');
    }

    public function get()
    {
        $zebras = ZebraStorage::with(['catalog', 'category'])->get();
        return response()->json($zebras);
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
        $item = ZebraStorage::create($request->item);
        $new_item = $item->with(['catalog', 'category'])->find($item->id);
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
        $zebra = ZebraStorage::find($id);
        $parts = ZebraPartsStorage::with(['type', 'status', 'provider', 'zebraStorage'])->where('zebra_storage_id', $id)->orderBy('type_id')->get();
        $actions = ZebraActionsStorage::index($id)->filter()->paginate('10');
        return view('admin.storage.zebra.show', compact('zebra', 'parts', 'actions'));
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
        $item = $request->item;
        ZebraStorage::find($id)->update($item);
        return response()->json(ZebraStorage::with(['catalog', 'category'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ZebraStorage::destroy($id);
        return response($id);
    }
}
