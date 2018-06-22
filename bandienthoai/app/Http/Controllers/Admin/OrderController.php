<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Order::select('*');

        if (isset($request->keyword) && !empty($request->keyword)){
            $list = $list->where('name','like', '%'.$request->keyword.'%')->orwhere('phone','like', '%'.$request->keyword.'%')->orwhere('email','like', '%'.$request->keyword.'%');
        }
        $list = $list->paginate(10);

        return view('admin.order.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        if (!empty($request->user_id)){
            $order->user_id = $request->user_id;
        }
        $order->name = $request->name;
        $order->gender = $request->gender;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->total = $request->total;
        $order->payment = $request->payment;
        $order->status = $request->status;
        $order->save();

        session()->flash('success', $order->name.' created successfully !');
        return redirect('admin/order');
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
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
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
        $order = Order::findOrFail($id);
        if (!empty($request->user_id)){
            $order->user_id = $request->user_id;
        }
        $order->name = $request->name;
        $order->gender = $request->gender;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->total = $request->total;
        $order->payment = $request->payment;
        $order->status = $request->status;
        $order->save();

        session()->flash('success', $order->name.' updated successfully !');
        return redirect('admin/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        $orderDetail = OrderDetail::where('order_id', $id)->get();
        foreach ($orderDetail as $item){
            $item->delete();
        }

        session()->flash('success', $order->name.' deleted successfully !');
        return redirect()->back();
    }
}
