<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use ShoppingCart;
use Session;

class CartController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->discount > 0) {
            $giaDangBan = $product->price - ($product->price / 100) * $product->discount;
            $giaGoc = $product->price;
        } else {
            $giaDangBan = $product->price;
            $giaGoc = $product->price;
        }

        if (isset($request->quantity) && isset($request->color)) {
            $quantity = $request->quantity;
            $color = $request->color;
        } else {
            $quantity = 1;
            $color = 'màu gì cũng được';
        }

        ShoppingCart::add(
            $product->id, $product->name, $quantity, $giaDangBan,
            [
                'color' => $color,
                'thumbnail' => $product->thumbnail,
                'discount' => $product->discount,
                'giaGoc' => $giaGoc
            ]
        );

        //ShoppingCart::destroy();

        session()->flash('success', ' Đã thêm ' . $product->name . ' vào giỏ hàng !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        foreach (ShoppingCart::all() as $item) {
            if ($item->id == $id) {
                ShoppingCart::update($item->__raw_id, $request->quantity);
                session()->flash('success', ' Đã cập nhật số lượng ' . $item->name . ' thành công !');
                break;
            }
        }

        session()->flash('success', 'Đã cập nhật giỏ hàng thành công !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach (ShoppingCart::all() as $item) {
            if ($item->id == $id) {
                ShoppingCart::remove($item->__raw_id);
                session()->flash('success', ' Đã xóa ' . $item->name . ' khỏi giỏ hàng !');
                break;
            }
        }

        return redirect()->back();
    }
}
