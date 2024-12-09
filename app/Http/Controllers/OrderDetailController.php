<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountOrderDetail;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public function index(){
        if (Auth::user()->role == "admin") {
            $orders = AccountOrderDetail::with('orderDetails.product')->paginate(10);
        } else {
            $orders = AccountOrderDetail::with('orderDetails.product')->where('account_id', '=', Auth::id())->paginate(10);
        }
        return view('order.order', compact('orders'));
    }

    public function store(Request $request){
        $accountOrderDetail = AccountOrderDetail::create([
            'status' => 'Waiting Payment',
            'account_id' => Auth::id(),
        ]);

        foreach($request->carts as $cart){
            OrderDetail::create([
                'quantity' => $cart['quantity'],
                'product_id' => $cart['product_id'],
                'accountorderdetail_id' => $accountOrderDetail->id,
            ]);
        }

        Cart::where('account_id', Auth::id())->delete();

        return redirect()->route('orders.payment', $accountOrderDetail->id);
    }

    public function payment($id){
        $orders = AccountOrderDetail::with(['orderDetails.product.pictures'])->findOrFail($id);
        $user = Auth::user();
        if($orders->status == "Waiting Payment")
            return view('order.payment', compact('orders', 'user'));
        else
            return redirect()->route('products.index');
    }

    public function cancel($id){
        $order = AccountOrderDetail::findOrFail($id);
        $order->status = 'Cancelled';
        $order->save();
        return redirect()->route('orders.index');
    }

    public function processPayment(Request $request, $id){
        $orders = AccountOrderDetail::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'address' => 'required',
        ]);
        $user = Account::findOrFail(Auth::id());
        $user->update($validated);
        $orders->status = "Processing Order";
        $orders->processing = now()->addDays(1);
        $orders->deliver = now()->addDays(1);
        $orders->arrive = now()->addDays(2);
        $orders->payment = now()->addDays(0);
        $orders->save();
        foreach($orders->orderDetails as $order){
            $product = Product::findOrFail($order->product->id);
            $product->stock = $product->stock - $order->quantity;
            $product->save();
        }
        return redirect()->route('orders.summary', $id);
    }

    public function summary($id){
        $orders = AccountOrderDetail::findOrFail($id);
        $user = Account::findOrFail(Auth::id());
        return view('order.summary', compact('orders', 'user'));
    }

    public function track($id){
        $orders = AccountOrderDetail::with(['orderDetails.product.pictures'])->findOrFail($id);
        return view('order.detail', compact('orders'));
    }

    public function processDeliver($id){
        $orders = AccountOrderDetail::findOrFail($id);
        $orders->status = "Shipping";
        $orders->processing = now();
        $orders->deliver = now();
        $orders->save();
        return redirect()->route('orders.index');
    }

    public function completed($id){
        $orders = AccountOrderDetail::findOrFail($id);
        $orders->status = "Completed";
        $orders->arrive = now();
        $orders->save();
        return redirect()->route('orders.index');
    }
}
