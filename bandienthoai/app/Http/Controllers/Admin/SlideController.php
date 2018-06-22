<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Slide::select('*')->paginate(10);
        return view('admin.slide.list', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('slides')) {
            $files = $request->file('slides');
            foreach ($files as $file) {
                $slide = new Slide();
                $fileName = $file->getClientOriginalName();
                $slide->name = $fileName;
                $file->move(public_path('uploads/slide'), $fileName);
                $slide->save();
            }
        }

        session()->flash('success', 'Slide created successfully !');
        return redirect('admin/slide');
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
        $slide = Slide::findOrFail($id);
        return view('admin.slide.edit', compact('slide'));
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
        if ($request->has('slide')) {

            $slide = Slide::findOrFail($id);
            if (file_exists('uploads/slide/' . $slide->name)) {
                unlink(public_path('uploads/slide/' . $slide->name)); // xoa anh cu
            }

            $file = $request->file('slide');
            $fileName = $file->getClientOriginalName();
            $slide->name = $fileName;
            $file->move(public_path('uploads/slide'), $fileName);
            $slide->save();

            session()->flash('success', 'Slide updated successfully !');
        }

        return redirect('admin/slide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();

        session()->flash('success', 'Slide deleted successfully !');
        return redirect('admin/slide');
    }
}
