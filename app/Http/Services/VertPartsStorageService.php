<?php


namespace App\Http\Services;


use Illuminate\Http\Request;

class VertPartsStorageService
{
    public static function cutPart(Request $request, $part)
    {
        $part->lenght -= $request->lenght;
        $part->save();
    }
}
