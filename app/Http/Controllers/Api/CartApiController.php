<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartApiController extends Controller
{
    //
    public function show()
    {
        $user=Auth::user();
        $cart=Cart::with('product:id,name_en,description_en,price,quantity,imagePath','user:id,name,email')
        ->where('user_id',$user->id)->get();

        if($cart->isEmpty())
        {
            return response()->json([
                'status'=>'error',
                'data'=>'No Cart Found'
            ],404);

        }

         return response()->json([
                'status'=>'success',
                'count'=>$cart->count(),
                'data'=>$cart,
            ],200);
    }

    public function store(Request $request)
    {
        $user=Auth::user();
        $validator=Validator::make($request->all(),[
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
             return response()->json([
                'status'=>'error',
                'data'=>$validator->errors(),
            ],422);
        }
        $cart=Cart::where('user_id',$user->id)->where('product_id',$request->product_id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        }
        else {
            $cart=Cart::create([
                'user_id'=>$user->id,
                'quantity'=>$request->quantity,
                'product_id'=>$request->product_id,

            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart',
            'data' => $cart,
        ], 201);

    }
    public function update(Request $request,$id)
    {
        $user=Auth::user();
        $validator=Validator::make($request->all(),[
            'quantity'=>'d|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error'
            , 'data' => $validator->errors(),
        ], 422);
        }

       $cart = Cart::where('id', $id)->where('user_id', $user->id)->first();

        if (!$cart) {
             return response()->json([
                'status'=>'error',
                'data'=>'No Cart Found',
            ],404);
        }

        $cart->update(['quantity'=>$request->quantity]);

         return response()->json([
            'status' => 'success',
            'message' => 'Quantity Updated',
            'data' => $cart,
        ], 201);
    }

    public function destroy($id)
    {
        $user=Auth::user();
        $cart=Cart::where('id',$id)->where('user_id',$user->id);
         if (!$cart) {
             return response()->json([
                'status'=>'error',
                'data'=>'No Cart Found',
            ],404);
        }

        $cart->delete();
         return response()->json([
            'status' => 'success',
            'message' => 'Item Deleted Successfully',

        ]);
    }
    public function clear()
    {
        $user = Auth::user();

        Cart::where('user_id', $user->id)->delete();

         return response()->json([
            'status' => 'success',
            'message' => 'Cart Cleared Successfully',

        ],200);
    }
}
