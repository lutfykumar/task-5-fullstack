<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['model'] = Articles::paginate(10);
        return view('post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Categories::all();
        return view('post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,svg|max:2048',
            'category_id' => 'required',
        ]);
        $image_path = $request->file('image')->store('image', 'public');
        $input = $request->all();
        $input['slug'] = Str::slug($input['title']) . '-' . rand(99, 99999);
        $input['image'] = $image_path;
        $input['user_id'] = Auth::id();
        Articles::create($input);

        return redirect()->route('post.index')->with('status', 'Post create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['model'] = Articles::find($id);
        return view('post.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['model'] = Articles::find($id);
        $data['category'] = Categories::all();
        return view('post.edit', $data);
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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpg,png,jpeg,svg|max:2048',
            'category_id' => 'required',
        ]);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
            $input['image'] = $image_path;
        }
        $input['slug'] = Str::slug($input['title']) . '-' . rand(99, 99999);
        $input['user_id'] = Auth::id();
        Articles::find($id)->update($input);

        return redirect()->route('post.index')->with('status', 'Post update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articles::find($id)->delete();
        return redirect()->route('post.index')->with('status', 'Post delete successfully.');
    }
}
