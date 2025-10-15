<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    //
    public function getProducts($category_id)
    {

        $products = Product::where('category_id', $category_id)->paginate(3);
        // dd($products);

        return view('product', compact('products'));
    }

    public function getAllProducts()
    {

        $products = Product::orderBy('category_id', 'asc')->paginate(2);
        // dd($products);

        return view('product', compact('products'));
    }

    public function addproduct()

    {
        $categories = Category::all();
        return view('admin.operations.addproduct', compact('categories'));
    }

    public function storeproduct(Request $request)
    {

        $request->validate([
            'name_en' => ['required', 'max:50'],
            'price' => 'required',
            'quantity' => 'required',
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $product = new Product();

        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $product->imagePath = 'uploads/' . $imageName;
        }

        $product->save();
        return redirect(route('allproductsforadmin'))->with('success', __('messages.added_product'));
    }

    public function deleteproduct($product_id = null)
    {
        if ($product_id) {

            $product = Product::find($product_id);

            if ($product) {

                if ($product->imagePath && file_exists(public_path($product->imagePath))) {
                    unlink(public_path($product->imagePath));
                }
                $product->delete();
            }


            return redirect(route('allproductsforadmin'))->with('success', __('messages.deleted_product'));
        } else {
            abort(403, 'Please Write Product Id In The Route');
        }
    }

    public function editproduct($id = null)
    {
        if ($id) {          // if no id written in url    editproduct/no id
            $categories = Category::all();
            $product = Product::find($id);
            if ($product == null) {     //  if id not exist in DB
                abort(403, "Can't Find Product");
            }

            return view('admin.operations.editproduct', compact('categories', 'product'));
        } else {
            $products = Product::all();
            return view('admin.operations.editproduct', compact('products'));
        }
    }

    public function updateproduct(Request $request, $id = null)
    {
        if ($id) {

            $request->validate([
                'name_en' => ['required', 'max:50'],
                'price' => 'required',
                'quantity' => 'required',
                'updatedimage' => ['nullable', 'max:2048', 'mimes:png,jpg,jpeg'],
            ]);

            $product = Product::findorfail($id);
            $product->name_en = $request->name_en;
            $product->name_ar = $request->name_ar;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description_en = $request->description_en;
            $product->description_ar = $request->description_ar;
            $product->category_id = $request->category_id;

            if ($request->hasFile('updatedimage')) {

                if ($product->imagePath && file_exists(public_path($product->imagePath))) {
                    unlink(public_path($product->imagePath));
                }
                $imageName = uniqid() . '.' . $request->updatedimage->extension();
                $request->updatedimage->move(public_path('uploads'), $imageName);

                $product->imagePath = 'uploads/' . $imageName;
            }

            $product->save();

            return redirect(route('allproductsforadmin'))->with('success', __('messages.updated_product'));
        } else {
            $products = Product::all();
            return redirect(route('allproductsforadmin'), compact('products'));
        }
    }

        public function search(Request $request)
    {
        $searchKey = $request->searchkey;


        $category = Category::where('name_en', 'like', "%$searchKey%")
            ->orWhere('name_ar', 'like', "%$searchKey%")
            ->first();

        if ($category) {

            $products = $category->product()->paginate(6);
        } else {

            $products = Product::where('name_en', 'like', "%$searchKey%")
                ->orWhere('name_ar', 'like', "%$searchKey%")
                ->paginate(6);
        }

        return view('product', compact('products', 'searchKey'));
    }



    public function productTable()
    {
        $products = Product::all();
        // dd($products);

        return view('products.productTable', compact('products'));
    }

    public function addimages($id = null)
    {
        if (!$id) {
            abort(403, 'Please Write Correct Id');
        }

        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $productImages = ProductImages::with('product')
            ->where('product_id', $product->id)
            ->get();

        return view('admin.operations.addimages', compact('product', 'productImages'));
    }


    public function storeimages(Request $request, $id)
    {
        $request->validate(
            [
                'images' => ['required'],
                'images.*' => ['image', 'mimes:png,jpg,jpeg', 'image', 'max:2048'],
            ],
            [
                'images.required'   => 'Please upload at least one image.',
                'images.*.image'    => 'The file must be an image.',
                'images.*.mimes'    => 'The image must be of type: png, jpg, jpeg.',
                'images.*.max'      => 'The image size must not exceed 2MB.',

            ]
        );
        if (!$id) {
            abort(403, 'Please Write Correct Id');
        }

        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $productImages = new ProductImages();
                $productImages->product_id = $product->id;

                $imageName = uniqid() . '.' . $image->extension();
                $image->move(public_path('uploads'), $imageName);
                $productImages->images = 'uploads/' . $imageName;

                $productImages->save();
            }
        }

        return redirect()->route('addimages', $product->id)
            ->with('success', __('messages.Images Added Successfully'));
    }

    public function deleteimage($id)
    {
        if ($id) {
            $productImage = ProductImages::find($id);
            if (!$productImage) {
                abort(404, "Image Not Found");
            }

            $productImage->delete();
            return redirect()->route('addimages', $productImage->product_id)->with('success', __('messages.Image Deleted Successfully'));
        } else {
            abort(403, 'Please Write Correct Id');
        }
    }

    public function ProdutDetails($id)
    {
       if (!$id) {
            abort(403, 'Please Write Correct Id');
        }

        $product=Product::with('category','images')->where('id',$id)->first();

        if (!$product) {
            abort(403, 'Product not found');
        }


        $priceRange=$product->price * 0.10;
        $minPrice= $product->price - $priceRange;
        $maxPrice= $product->price + $priceRange;

        $relatedProducts=Product::where('category_id',$product->category_id)
        ->where('id','!=',$product->id)
        // ->whereBetween('price',[$minPrice,$maxPrice])
        ->inRandomOrder()->limit(3)->get();

        return view('products.productdetails',compact('product','relatedProducts'));
    }



}
