<?php

namespace App\Http\Controllers;

use App\Models\RollPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RollPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = RollPrice::filter()->get()->groupBy('height')->map->keyBy('width')->except('id');
        //dd($prices);
        return view('admin.prices.roll.index', compact('prices'));
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
        //
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
    public function update(Request $request)
    {
        $array = $request->all();
        $flattened = collect($array)->flatten(1)->toArray();
        Arr::except($flattened, ['id']);
        RollPrice::truncate();
        foreach($flattened as $item)
        {
            RollPrice::create([
                'construction_id' => $item['construction_id'],
                'catalog_id' => $item['catalog_id'],
                'category_id' => $item['category_id'],
                'width' => $item['width'],
                'height' => $item['height'],
                'price' => $item['price']
            ]);
        }
        return response()->json($flattened);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
