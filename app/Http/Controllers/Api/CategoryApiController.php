<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryApiController extends Controller
{
    //

    public function index()
    {
        $categories=Category::with('product:id,name_en,description_en,imagePath,quantity,price,category_id')->get();

        return response()->json([
            'status'=>'success',
            'count'=>$categories->count(),
            'data'=>$categories,
        ],200);
    }

    public function show($id)
    {
        $category=Category::with('product:id,name_en,description_en,imagePath,quantity,price,category_id')->find($id);

        if (!$category) {
            return response()->json([
            'status'=>'error',
            'data'=>'Category Not Found',
        ],400);

        }
        return response()->json([
            'status'=>'success',
            'data'=>$category,
        ],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => ['required', 'max:50'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['imagePath'] = 'uploads/' . $imageName;
        }

        $category = Category::create([
            'name_en'         => $data['name_en'],
            'name_ar'      => $data['name_ar'] ?? null,
            'description_en'  => $data['description_en'] ?? null,
            'description_ar' => $data['description_ar'] ?? null,
            'imagePath'    => $data['imagePath'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'category Created Successfully',
            'data' => $category,
        ], 201);
    }

     public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category Not Found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name_en' => ['sometimes', 'required', 'max:50'],
            'description_en' => 'nullable|string',
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // لو فيه صورة جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة لو موجودة
            if ($category->imagePath && file_exists(public_path($category->imagePath))) {
                unlink(public_path($category->imagePath));
            }

            $imageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['imagePath'] = 'uploads/' . $imageName;
        }

        $category->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Category Updated Successfully',
            'data' => $category,
        ], 200);
    }



    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

        if ($category->imagePath && file_exists(public_path($category->imagePath))) {
            unlink(public_path($category->imagePath));
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ], 200);
    }



}
