<?php

namespace App\Http\Controllers;

use App\Http\Services\FurnActionsStorageService;
use App\Http\Services\FurnPartsStorageService;
use App\Models\FurnActionsStorage;
use App\Models\FurnPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FurnPartsStorageController extends Controller
{
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
        FurnPartsStorage::create($request->all());
        $action = new FurnActionsStorage;
        $action -> furn_storage_id = $request->furn_storage_id;
        $action -> type_id = 1;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> count = $request->count;
        $action->save();
        return redirect(route('furn.show', ['id' => $request->furn_storage_id]))->with(['part_status' => 'Партия успешно добавлена!', 'part_color' => 'success']);
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
        $part = FurnPartsStorage::find($id);
        FurnPartsStorageService::cutPart($request, $part);
        FurnActionsStorageService::createAction($request);
        return redirect(route('furn.show', ['id' => $request->furn_storage_id]))->with(['part_status' => 'Изменения сохранены!', 'part_color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $action = new FurnActionsStorage;
        $action -> furn_storage_id = $request->furn_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> count = $request->count;
        $action->save();
        FurnPartsStorage::destroy($id);
        return redirect(route('furn.show', ['id' => $request->furn_storage_id]))->with(['part_status' => 'Предмет успешно удален!', 'part_color' => 'danger']);
    }
}
