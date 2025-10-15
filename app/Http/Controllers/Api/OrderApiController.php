<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderApiController extends Controller
{
    // 🧾 عرض كل الطلبات الخاصة بالمستخدم
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with(['order_details.product:id,name_en,price,imagePath'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $orders->count(),
            'data' => $orders
        ], 200);
    }

    // 🛒 إنشاء طلب جديد من محتويات الكارت
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|string|in:cash,card',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'data' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cart is empty'], 400);
        }

        // 🧮 حساب الإجمالي
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // 🧾 إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'note' => $request->note,
            'payment_method' => $request->payment_method,
            'payment_status' => 'notyet',
        ]);

        // 🧩 إنشاء تفاصيل الطلب
        foreach ($cartItems as $item) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // 🧹 حذف الكارت بعد إنشاء الطلب
        Cart::where('user_id', $user->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Order Created Successfully',
            'data' => $order->load('order_details.product'),
        ], 201);
    }

    // 🔍 عرض تفاصيل طلب واحد
    public function show($id)
    {
        $user = Auth::user();

        $order = Order::with('order_details.product:id,name_en,price,imagePath')
            ->where('user_id', $user->id)
            ->find($id);

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $order], 200);
    }

    // ❌ حذف الطلب
    public function destroy($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->find($id);

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        $order->order_details()->delete();
        $order->delete();

        return response()->json(['status' => 'success', 'message' => 'Order deleted successfully'], 200);
    }
}
