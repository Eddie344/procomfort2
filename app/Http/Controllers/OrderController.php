<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    public function getAll()
    {
        $orders = Order::with(['user', 'productType', 'constructionType', 'status', 'diller', 'paymentType'])->filter()->get();
        return response()->json($orders);
    }

    public function get($id)
    {
        $order = Order::with(['user', 'productType', 'constructionType', 'status', 'diller', 'paymentType'])->find($id);
        return response()->json($order);
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
        $order = Order::create($request->order);
        $new_order = $order->with(['user', 'productType', 'constructionType', 'status', 'diller', 'paymentType'])->find($order->id);
        return response()->json($new_order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.orders.show', compact('order'));
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
        $order = Order::find($id);
        $order->update($request->order);
        return response()->json(Order::with(['user', 'productType', 'constructionType', 'status', 'diller', 'paymentType'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return response($id);
    }

    public function restore($id)
    {
        Order::withTrashed()->find($id)->restore();
        return response($id);
    }
}
