<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    //

    public function getCategories()
    {
        $categories = Category::paginate(3);
        $products = Product::latest()->take(3)->get();

        // dd($reult);
        return view('welcome', compact('categories', 'products'));
    }

    public function AllCategories()
    {
        $categories = Category::paginate(3);
        $products = Product::paginate(3);

        return view('category', compact('categories', 'products'));
    }

    public function addcategory()
    {
        return view('admin.operations.addcategory');
    }

    public function storecategory(Request $request)
    {

        $request->validate([
            'name_en' => ['required', 'max:50'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $category = new Category();

        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;

        $category->description_en = $request->description_en;
        $category->description_ar = $request->description_ar;


        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $category->imagePath = 'uploads/' . $imageName;
        }

        $category->save();
        return redirect()->route('categoriesforadmin')->with('success', __('messages.added_product'));
    }
    public function editcategory($id)
    {
        if ($id) {          // if no id written in url    editproduct/no id
            $category = Category::find($id);

            if ($category == null) {     //  if id not exist in DB
                abort(403, "Can't Find Category");
            }

            return view('admin.operations.editcategory', compact('category'));
        }
    }

    public function updatecategory(Request $request, $id = null)
    {
        if ($id) {

            $request->validate([
                'name_en' => ['required', 'max:50'],

                'updatedimage' => ['nullable', 'max:2048', 'mimes:png,jpg,jpeg'],
            ]);

            $category = Category::findorfail($id);
            $category->name_en = $request->name_en;
            $category->name_ar = $request->name_ar;

            $category->description_en = $request->description_en;
            $category->description_ar = $request->description_ar;


            if ($request->hasFile('updatedimage')) {

                if ($category->imagePath && file_exists(public_path($category->imagePath))) {
                    unlink(public_path($category->imagePath));
                }
                $imageName = uniqid() . '.' . $request->updatedimage->extension();
                $request->updatedimage->move(public_path('uploads'), $imageName);

                $category->imagePath = 'uploads/' . $imageName;
            }

            $category->save();

            return redirect()->route('categoriesforadmin')->with('success', __('messages.updated_product'));
        }
    }

    public function deletecategory($id=null)
    {
        if ($id) {
            $category=Category::find($id);
            if($category){
                if ($category->imagePath && file_exists(public_path($category->imagePath))) {
                    unlink(public_path($category->imagePath));
                }
                $category->delete();
            }
             return redirect(route('categoriesforadmin'))->with('success', 'Category Deleted Successfully');
        } else {
            abort(403, 'Please Write Category Id In The Route');
        }


        }


    }

