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
        GorizPartsStorage::create($request->all());
        $action = new GorizActionsStorage;
        $action -> goriz_storage_id = $request->goriz_storage_id;
        $action -> type_id = 1;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
        return redirect(route('goriz.show', ['id' => $request->goriz_storage_id]))->with(['part_status' => 'Партия успешно добавлена!', 'part_color' => 'success']);
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
        $part = GorizPartsStorage::find($id);
        GorizPartsStorageService::cutPart($request, $part);
        GorizActionsStorageService::createAction($request);
        return redirect(route('goriz.show', ['id' => $request->goriz_storage_id]))->with(['part_status' => 'Изменения сохранены!', 'part_color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $action = new GorizActionsStorage;
        $action -> goriz_storage_id = $request->goriz_storage_id;
        $action -> type_id = $request->type_id;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> lenght = $request->lenght;
        $action->save();
        GorizPartsStorage::destroy($id);
        return redirect(route('goriz.show', ['id' => $request->goriz_storage_id]))->with(['part_status' => 'Предмет успешно удален!', 'part_color' => 'danger']);
    }
}
