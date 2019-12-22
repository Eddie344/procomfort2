<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RollProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RollProductController extends Controller
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

    public function getAll()
    {
        $products = RollProduct::with(['order', 'type', 'construction', 'rule', 'material', 'complectation', 'measurement', 'mount', 'furnColor'])
            ->filter()
            ->get()
            ->sortByDesc('created_at')
            ->values()
            ->all();
        return response()->json($products);
    }

//    public function get($id)
//    {
//        $order = Order::with(['user', 'productType', 'constructionType', 'status', 'diller', 'paymentType'])->find($id);
//        return response()->json($order);
//    }


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
        for($i = 0; $i < $request->count; $i++)
        {
            $product = RollProduct::create($request->product);
        }
//        $new_product = $product->with(['order', 'type', 'construction', 'rule', 'material', 'complectation', 'measurement', 'mount', 'furnColor'])->find($product->id);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.orders.show', compact('id'));
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
        $product = RollProduct::find($id);
        $product->update($request->product);
        return response('ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RollProduct::destroy($id);
        return response($id);
    }

    public function restore($id)
    {
        Order::withTrashed()->find($id)->restore();
        return response($id);
    }
}
