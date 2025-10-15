<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;


class OrderController extends Controller
{
    //
    public function completeOrder()
    {
        $user = Auth::user();
        $carts = Cart::with('product', 'user')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', __('messages.cart_empty'));
        }

        $subtotal = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });



        return view('products.completeorder', compact('carts', 'subtotal'));
    }





    public function StoreOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|digits:11',
            'payment_method' => 'required'
        ]);

        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();
        if ($carts->isEmpty()) return back()->with('error', 'Your cart is empty.');

        // $total = $carts->sum(fn($cart) => $cart->quantity * $cart->product->price);

        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method == 'cash' ? 'pending' : 'unpaid',
            // 'total' => $total
        ]);

        foreach ($carts as $cart) {
            $order->products()->attach($cart->product_id, ['quantity' => $cart->quantity, 'price' => $cart->product->price]);
        }

        if ($request->payment_method == 'cash') {
            Cart::where('user_id', $user->id)->delete();
            session([
                'paidOrNot' => "notyet",
                'order_id' => $order->id
            ]);

            return redirect()->route('payment_success');
        }

        if ($request->payment_method == 'card') {
            Stripe::setApiKey(config('services.stripe.secret'));

            $line_items = [];
            foreach ($carts as $cart) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => $cart->product->name_en],
                        'unit_amount' => $cart->product->price * 100,
                    ],
                    'quantity' => $cart->quantity
                ];
            }

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('stripe.success', ['order' => $order->id]),
                'cancel_url' => route('stripe.cancel', ['order' => $order->id]),
            ]);

            return redirect($session->url);
        }
    }



    public function previousorders()
    {

        $user = Auth::user();
        $orders = Order::with('order_details')->where('user_id', $user->id)->get();


        $carts = Cart::with('product')->where('user_id', $user->id)->get();



        // اجمالي السعر
        $subtotal = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('products.previousorders', compact('orders', 'carts', 'subtotal'));
    }

    public function pay_success()
    {
        if (!session()->has('order_id')) {
            return redirect()->route('mainPage')->with('error', 'No order found.');
        }

        $order = Order::find(session('order_id'));
        $paidOrNot = session('paidOrNot');
        $badgeClass = $paidOrNot === 'paid' ? 'bg-success' : 'bg-warning';

        return view('products.payment-success', compact('order', 'paidOrNot','badgeClass'));
    }
}
