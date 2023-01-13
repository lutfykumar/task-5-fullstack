<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Articles::paginate('5');
        $data['model'] = $articles;
        $categories = Categories::all();
        $one = [];
        $two = [];
        foreach ($categories as $key => $i) {
            if ($key % 2 == 0) {
                $one[] = [
                    'link' => url('c/' . $i->slug),
                    'name' => $i->name,
                ];
            } else {
                $two[] = [
                    'link' => url('c/' . $i->slug),
                    'name' => $i->name,
                ];
            }
        }
        $data['cat_one'] = $one;
        $data['cat_two'] = $two;
        return view('home', $data);
    }

    public function categorySlug($slug)
    {
        $category = Categories::where('slug', $slug)->first();
        $model = Articles::where('category_id', $category->id)->paginate(6);
        $data['category'] = $category;
        $data['model'] = $model;
        return view('category-slug', $data);
    }

    public function postSlug($slug)
    {
        $model = Articles::where('slug', $slug)->first();
        $data['model'] = $model;
        return view('post-slug', $data);
    }
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required'
        ]);
        $keyword = $request->input('keyword');
        $model = Articles::where('title', 'like', "%{$keyword}%")->get();
        $data['keyword'] = $keyword;
        $data['model'] = $model;
        return view('post-search', $data);
    }
}
