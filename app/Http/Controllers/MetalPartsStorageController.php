<?php

namespace App\Http\Controllers;

use App\Http\Services\MetalActionsStorageService;
use App\Http\Services\MetalPartsStorageService;
use App\Models\MetalActionsStorage;
use App\Models\MetalPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetalPartsStorageController extends Controller
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
        MetalPartsStorage::create($request->all());
        $action = new MetalActionsStorage;
        $action -> metal_storage_id = $request->metal_storage_id;
        $action -> type_id = 1;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
        return redirect(route('metal.show', ['id' => $request->metal_storage_id]))->with(['part_status' => 'Партия успешно добавлена!', 'part_color' => 'success']);
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
        $part = MetalPartsStorage::find($id);
        MetalPartsStorageService::cutPart($request, $part);
        MetalActionsStorageService::createAction($request);
        return redirect(route('metal.show', ['id' => $request->metal_storage_id]))->with(['part_status' => 'Изменения сохранены!', 'part_color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $action = new MetalActionsStorage;
        $action -> metal_storage_id = $request->metal_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
        MetalPartsStorage::destroy($id);
        return redirect(route('metal.show', ['id' => $request->metal_storage_id]))->with(['part_status' => 'Предмет успешно удален!', 'part_color' => 'danger']);
    }
}
