<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    //

    public function getReviews()
    {
        $reviews = Review::all();
        return view('reviews', compact('reviews'));
    }

    public function storeReview(Request $request)
    {



        if (Auth::user()) {
            $request->validate([

                'phone' => ['required','numeric','digits:11'],
                'image' => ['nullable', 'image', 'mimes:png,jpeg,jpg', 'max:2048'],
                'subject' => 'required',
                'message' => 'required',

            ]);
            $review = new Review;
            $review->name = Auth::user()->name;
            $review->email = Auth::user()->email;

            $review->phone = $request->phone;
            if ($request->hasFile('image')) {
                $imageName = uniqid() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imageName);
                $review->image = 'uploads/' . $imageName;
            }
            $review->subject = $request->subject;
            $review->message = $request->message;
            $review->save();

            return redirect('/reviews')->with('success', __('messages.review_added'));
        } else {
            $request->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email'],
                'phone' => ['required','numeric','digits:11'],
                'image' => ['nullable', 'image', 'mimes:png,jpeg,jpg', 'max:2048'],
                'subject' => 'required',
                'message' => 'required',

            ]);
            $review = new Review;
            $review->name = $request->name;
            $review->email = $request->email;
            $review->phone = $request->phone;
            if ($request->hasFile('image')) {
                $imageName = uniqid() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imageName);
                $review->image = 'uploads/' . $imageName;
            }
            $review->subject = $request->subject;
            $review->message = $request->message;
            $review->save();

            return redirect('/reviews')->with('success', __('messages.review_added'));
        }
    }
}
