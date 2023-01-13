<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoriesResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends BaseController
{
    public function listAll(Request $request)
    {
        $pageSize = $request->page_size ?? 5;
        $model = Categories::paginate($pageSize);
        return CategoriesResource::collection($model);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['slug'] = Str::slug($input['name']);
        $model = Categories::create($input);

        return $this->sendResponse($model, 'Category create successfully.');
    }
    public function showDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Categories::find($request->input('id'));

        return $this->sendResponse($model, 'Category detail successfully.');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $input['slug'] = Str::slug($input['name']);
        $model = Categories::find($input['id'])->update($input);
        if ($model) {
            $category = Categories::find($input['id']);
            return $this->sendResponse($category, 'Category update successfully.');
        } else {
            return $this->sendError('failed', 'Category update failed.');
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

        $model = Categories::find($request->input('id'))->delete();
        if ($model) {
            return $this->sendResponse(['id' => $request->input('id')], 'Category delete successfully.');
        } else {
            return $this->sendError('Failed', 'Category delete failed.');
        }
    }
}
