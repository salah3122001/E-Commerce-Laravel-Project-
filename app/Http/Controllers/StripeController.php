<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    //
    public function checkout()
    {
        $userId = auth()->id();

        // استرجاع محتويات الكارت للمستخدم الحالي
        $carts = Cart::with('product')->where('user_id', $userId)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', __('messages.cart_empty'));
        }

        // حساب الإجمالي
        $subtotal = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('products.checkout', compact('carts', 'subtotal'));
    }

    public function session(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Test Product',
                    ],
                    'unit_amount' => 5000, // السعر بـ سنتس (5000 = 50.00$)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Order $order)
    {
        $order->payment_status = 'paid';
        $order->save();

        // مسح الكارت بعد الدفع
        Cart::where('user_id', $order->user_id)->delete();

        session([
            'paidOrNot' => "paid",
            'order_id' => $order->id
        ]);

        return redirect()->route('payment_success');
    }

    public function cancel(Order $order)
    {

        return redirect()->route('checkout')->with('error', __('messages.payment_cancel'));
    }
}
