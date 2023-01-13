<?php

namespace App\Http\Controllers\Api;

use App\Models\Articles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends BaseController
{
    public function listAll(Request $request)
    {
        $pageSize = $request->page_size ?? 5;
        $articles = Articles::paginate($pageSize);
        return PostResource::collection($articles);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $image_path = $request->file('image')->store('image', 'public');
        $input = $request->all();
        $input['slug'] = Str::slug($input['title']) . '-' . rand(99, 99999);
        $input['image'] = $image_path;
        $input['user_id'] = Auth::id();
        $model = Articles::create($input);

        return $this->sendResponse($model, 'Post create successfully.');
    }
    public function showDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Articles::find($request->input('id'));

        return $this->sendResponse($model, 'Post detail successfully.');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
            $input['image'] = $image_path;
        }
        $input['slug'] = Str::slug($input['title']) . '-' . rand(99, 99999);
        $input['user_id'] = Auth::id();
        $model = Articles::find($input['id'])->update($input);
        if ($model) {
            $article = Articles::find($input['id']);
            return $this->sendResponse($article, 'Post update successfully.');
        } else {
            return $this->sendError('failed', 'Post update failed.');
        }
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Articles::find($request->input('id'))->delete();
        if ($model) {
            return $this->sendResponse(['id' => $request->input('id')], 'Post delete successfully.');
        } else {
            return $this->sendError('Failed', 'Post delete failed.');
        }
    }
}
