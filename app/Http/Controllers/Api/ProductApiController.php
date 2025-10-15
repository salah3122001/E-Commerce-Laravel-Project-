<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    //

    public function index()
    {
        // $lang=App::getLocale();
        $products = Product::with('category:id,name_en')->Select('id', 'name_en', 'description_en', 'imagePath', 'quantity', 'price', 'category_id')->get();

        return response()->json([
            'status' => 'success',
            'count' => $products->count(),
            'data' => $products,
        ], 200);
    }

    public function show($id)
    {
        // $lang=App::getLocale();
        $product = Product::Select('id', 'name_en', 'description_en', 'imagePath', 'price', 'quantity', 'category_id')->find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'data' => 'Product Not Found',

            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product,

        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => ['required', 'max:50'],
            'description_en' => 'nullable|string',
            'price' => 'required',
            'quantity' => 'required',
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'category_id' => 'required|exists:categories,id',
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

        $product = Product::create([
            'name_en'         => $data['name_en'],
            'name_ar'      => $data['name_ar'] ?? null,
            'description_en'  => $data['description_en'] ?? null,
            'description_ar' => $data['description_ar'] ?? null,
            'price'        => $data['price'],
            'quantity'     => $data['quantity'],
            'category_id'  => $data['category_id'],
            'imagePath'    => $data['imagePath'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product Created Successfully',
            'data' => $product,
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product Not Found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name_en' => ['sometimes', 'required', 'max:50'],
            'description_en' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'category_id' => 'sometimes|required|exists:categories,id',
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
            if ($product->imagePath && file_exists(public_path($product->imagePath))) {
                unlink(public_path($product->imagePath));
            }

            $imageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['imagePath'] = 'uploads/' . $imageName;
        }

        $product->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Product Updated Successfully',
            'data' => $product,
        ], 200);
    }



    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        if ($product->imagePath && file_exists(public_path($product->imagePath))) {
            unlink(public_path($product->imagePath));
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
