<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::with('product.pictures')->where('account_id', '=', Auth::id())->whereHas('product', function($query){ $query->where('stock', '>', 0);})->get();
        return view('product.cart', compact('carts'));
    }

    public function delete($id){
        $cart = Cart::findOrFail($id);
        $cart->delete();
        // Return response karena delete pakai promise JS. Jadi nunggu response buat auto reload.
        return response()->json(['message' => 'Item deleted successfully.'], 200);
    }
}
