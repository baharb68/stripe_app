<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product, Request $request){
        $intent = auth()->user()->createSetupIntent();
        return view("subscription", compact(["product"]));
    }

    public function subscription(Request $request)
    {
        $product = Product::find($request->product);

        $subscription = $request->user()->newSubscription($request->product, $product->stripe_id)->create($request->token);
        return view('subscription_success');
    }
}
