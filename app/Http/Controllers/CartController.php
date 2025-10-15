<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // عرض صفحة الكارت
    public function cart()
    {
        $user = Auth::user();

        $carts = Cart::with('product')->where('user_id', $user->id)->get();



        // اجمالي السعر
        $subtotal = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('products.cart', compact('carts', 'subtotal'));
    }


    // إضافة منتج للكارت
    public function addcart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first to add to cart');
        }


        // لو المنتج موجود بالفعل في الكارت لنفس اليوزر → زوّد الكمية
        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->quantity = 1;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->save();
        }

        // بعد الإضافة → ارجع على صفحة cart بالبيانات
        return redirect()->route('cart')->with('success', __('messages.Product Added To Cart'));
    }
    public function deleteFromCart($id = null)
    {
        if ($id) {
            Cart::find($id)->delete();
            return redirect()->route('cart')->with('success', __('messages.Product Deleted Successfully From Cart'));
        } else {
            abort(403, 'Please Write Product Id In The Route');
        }
    }
    public function editcart(Request $request, $id)
    {
        $request->validate([
            "quantity$id" => 'required|integer|min:1',
        ], [
            "quantity$id.required" => "Please enter the quantity",
            "quantity$id.integer"  => "Quantity must be a number",
            "quantity$id.min"      => "Quantity must be at least 1",
        ], [
            "quantity$id" => "Quantity",
        ]);


        if ($id) {
            $cart = Cart::find($id);
            $cart->quantity = $request->input("quantity$id");
            $cart->save();
            return redirect()->route('cart')->with('success', __('messages.Quantity Updated Successfully'));
        } else {
            abort(403, 'Please Write Correct Id');
        }
    }


}
