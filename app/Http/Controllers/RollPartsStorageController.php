<?php

namespace App\Http\Controllers;

use App\Http\Services\RollActionStorageService;
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
        RollPartsStorage::create($request->all());
        $action = new RollActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = 1;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        return redirect(route('roll.show', ['id' => $request->roll_storage_id]))->with(['part_status' => 'Партия успешно добавлена!', 'part_color' => 'success']);
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
        $part = RollPartsStorage::find($id);
        RollPartsStorageService::cutPart($request, $part);
        RollPartsStorageService::createPiece($request, $part->width);
        RollActionStorageService::createAction($request);
        return redirect(route('roll.show', ['id' => $request->roll_storage_id]))->with(['part_status' => 'Изменения сохранены!', 'part_color' => 'success']);
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
        $action = new RollActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = 2;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        RollPartsStorage::destroy($id);
        return redirect(route('roll.show', ['id' => $request->roll_storage_id]))->with(['part_status' => 'Предмет успешно удален!', 'part_color' => 'danger']);
    }
}
