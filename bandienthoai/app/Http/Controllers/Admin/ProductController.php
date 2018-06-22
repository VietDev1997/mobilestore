<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Configuration;
use App\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Product::select('*');

        if (isset($request->keyword) && !empty($request->keyword)){
            $list = $list->where('name','like', '%'.$request->keyword.'%')->orwhere('price', $request->keyword);
        }
        $list = $list->paginate(10);
        return view('admin.product.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'screen' => 'required',
                'operating_system' => 'required',
                'front_camera' => 'required',
                'rear_camera' => 'required',
                'cpu' => 'required',
                'ram' => 'required',
                'internal_memory' => 'required',
                'sim' => 'required',
                'battery_capacity' => 'required'

            ],

            [
                'name.required' => 'bạn phải nhập tên sản phẩm',
                'price.required' => 'bạn phải nhập giá sản phẩm',
                'price.numeric' => 'bạn phải nhập giá sản phẩm là số',
                'screen.required' => 'bạn phải nhập kích thước màn hình',
                'operating_system.required' => 'bạn phải nhập hệ điều hành cho sản phẩm',
                'front_camera.required' => 'bạn phải nhập độ phân giải camera trước',
                'rear_camera.required' => 'bạn phải nhập độ phân giải camera sau',
                'cpu.required' => 'bạn phải nhập CPU',
                'ram.required' => 'bạn phải nhập RAM',
                'internal_memory.required' => 'bạn phải nhập bộ nhớ trong',
                'sim.required' => 'bạn phải nhập mục SIM',
                'battery_capacity.required' => 'bạn phải nhập dung lượng PIN',
            ]
        );

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        if (!empty($request->discount)) {
            $product->discount = $request->discount;
        }
        if ($request->has('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/product/thumbnail'), $fileName);
            $product->thumbnail = $fileName;
        }
        $product->description = $request->description;
        $product->detailed_description = $request->detailed_description;
        $product->status = $request->status;
        $product->save();

        $configuration = new Configuration();
        $configuration->screen = $request->screen;
        $configuration->operating_system = $request->operating_system;
        $configuration->front_camera = $request->front_camera;
        $configuration->rear_camera = $request->rear_camera;
        $configuration->cpu = $request->cpu;
        $configuration->ram = $request->ram;
        $configuration->internal_memory = $request->internal_memory;
        $configuration->sim = $request->sim;
        $configuration->battery_capacity = $request->battery_capacity;
        $configuration->product_id = $product->id;
        $configuration->save();

        if ($request->has('images')){
            $files = $request->file('images');
            foreach ($files as $file){
                $image = new Image();
                $fileName = $file->getClientOriginalName();
                $image->name = $fileName;
                $file->move(public_path('uploads/product/images'), $fileName);
                $image->product_id = $product->id;
                $image->save();
            }
        }

        session()->flash('success', $product->name.' created successfully !');
        return redirect('admin/product');
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
        $product = Product::findOrFail($id);
        $category = Category::pluck('name', 'id');
        return view('admin.product.edit', compact('product', 'category'));
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
        $this->validate($request,
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'screen' => 'required',
                'operating_system' => 'required',
                'front_camera' => 'required',
                'rear_camera' => 'required',
                'cpu' => 'required',
                'ram' => 'required',
                'internal_memory' => 'required',
                'sim' => 'required',
                'battery_capacity' => 'required'

            ],

            [
                'name.required' => 'bạn phải nhập tên sản phẩm',
                'price.required' => 'bạn phải nhập giá sản phẩm',
                'price.numeric' => 'bạn phải nhập giá sản phẩm là số',
                'screen.required' => 'bạn phải nhập kích thước màn hình',
                'operating_system.required' => 'bạn phải nhập hệ điều hành cho sản phẩm',
                'front_camera.required' => 'bạn phải nhập độ phân giải camera trước',
                'rear_camera.required' => 'bạn phải nhập độ phân giải camera sau',
                'cpu.required' => 'bạn phải nhập CPU',
                'ram.required' => 'bạn phải nhập RAM',
                'internal_memory.required' => 'bạn phải nhập bộ nhớ trong',
                'sim.required' => 'bạn phải nhập mục SIM',
                'battery_capacity.required' => 'bạn phải nhập dung lượng PIN',
            ]
        );

        $product = Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        if (!empty($request->discount)) {
            $product->discount = $request->discount;
        }
        if ($request->has('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            if (file_exists('uploads/product/thumbnail/' . $product->thumbnail)) {
                unlink(public_path('uploads/product/thumbnail/' . $product->thumbnail)); // xoa anh cu
            }
            $file->move(public_path('uploads/product/thumbnail'), $fileName);
            $product->thumbnail = $fileName;
        }
        $product->description = $request->description;
        $product->detailed_description = $request->detailed_description;
        $product->status = $request->status;
        $product->save();

        $configuration = Configuration::where('product_id', $product->id)->first();
        $configuration->screen = $request->screen;
        $configuration->operating_system = $request->operating_system;
        $configuration->front_camera = $request->front_camera;
        $configuration->rear_camera = $request->rear_camera;
        $configuration->cpu = $request->cpu;
        $configuration->ram = $request->ram;
        $configuration->internal_memory = $request->internal_memory;
        $configuration->sim = $request->sim;
        $configuration->battery_capacity = $request->battery_capacity;
        $configuration->product_id = $product->id;
        $configuration->save();


        if ($request->has('images')){
            $images = Image::where('product_id', $product->id)->get();
            foreach ($images as $image){
                if (file_exists('uploads/product/images/' . $image->name)) {
                    unlink(public_path('uploads/product/images/' . $image->name)); // xoa anh cu
                }
                $image->delete();
            }

            $files = $request->file('images');
            foreach ($files as $file){
                $image = new Image();
                $fileName = $file->getClientOriginalName();
                $image->name = $fileName;
                $file->move(public_path('uploads/product/images'), $fileName);
                $image->product_id = $product->id;
                $image->save();
            }
        }

        session()->flash('success', $product->name.' updated successfully !');
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if (file_exists('uploads/product/thumbnail/' . $product->thumbnail)) {
            unlink(public_path('uploads/product/thumbnail/' . $product->thumbnail)); // xoa anh cu
        }

        $images = Image::where('product_id', $product->id)->get();
        foreach ($images as $image){
            if (file_exists('uploads/product/images/' . $image->name)) {
                unlink(public_path('uploads/product/images/' . $image->name)); // xoa anh cu
            }
            $image->delete();
        }

        $product->delete();

        $configuration = Configuration::where('product_id', $id)->first();
        $configuration->delete();

        session()->flash('success', $product->name.' deleted successfully !');
        return redirect('admin/product');
    }
}
