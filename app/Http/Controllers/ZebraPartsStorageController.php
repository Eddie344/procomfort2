<?php

namespace App\Http\Controllers;

use App\Http\Services\ZebraActionStorageService;
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
        ZebraPartsStorage::create($request->all());
        $action = new ZebraActionsStorage;
        $action -> zebra_storage_id = $request->zebra_storage_id;
        $action -> type_id = 1;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        return redirect(route('zebra.show', ['id' => $request->zebra_storage_id]))->with(['part_status' => 'Партия успешно добавлена!', 'part_color' => 'success']);
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
        $part = ZebraPartsStorage::find($id);
        ZebraPartsStorageService::cutPart($request, $part);
        ZebraPartsStorageService::createPiece($request, $part->width);
        ZebraActionStorageService::createAction($request);
        return redirect(route('zebra.show', ['id' => $request->zebra_storage_id]))->with(['part_status' => 'Изменения сохранены!', 'part_color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $action = new ZebraActionsStorage;
        $action -> zebra_storage_id = $request->zebra_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        ZebraPartsStorage::destroy($id);
        return redirect(route('zebra.show', ['id' => $request->zebra_storage_id]))->with(['part_status' => 'Предмет успешно удален!', 'part_color' => 'danger']);
    }
}
