<?php


namespace App\Http\Services;

use App\Models\RollPartsStorage;
use Illuminate\Http\Request;

class RollPartsStorageService
{
    //Создание и сохранение остатка отреза
    public static function createPiece(Request $request, $partWidth)
    {
        $roll = new RollPartsStorage;
        $roll->roll_storage_id = $request->roll_storage_id;
        $roll->price = $request->price;
        $roll->provider_id = $request->provider;
        $roll->status_id = 1;
        $roll->type_id = 2;
        $roll->width = $partWidth - $request->width;
        $roll->lenght = $request->lenght;
        $roll->save();
    }

    public static function cutPart(Request $request, $part)
    {
        $part->lenght = $part->lenght - $request->lenght;
        $part->save();
    }
}
