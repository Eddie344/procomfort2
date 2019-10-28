<?php


namespace App\Http\Services;


use Illuminate\Http\Request;

class FurnPartsStorageService
{
    public static function cutPart(Request $request, $part)
    {
        $part->count -= $request->count;
        $part->save();
    }
}
