<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index(){
        if(Auth::check() &&  Auth::user()->role=="admin"){
            $products = Product::all();
        }else{
            $products = Product::where('stock', '>', 0)->get();
        }
        $categories = Category::all();
        return view('product.product', compact('products', 'categories'));
    }

    public function create(){
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $products = Product::create([
            'account_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($request->has('categories')) {
            $products->categories()->attach($request->categories);
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $picture = Picture::create([
                    'pictureLink' => $path,
                ]);
                $products->pictures()->attach($picture->id);
            }
        }

        return redirect()->route('products.index');
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('product.detail', compact('product'));
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function updatePage($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.update', compact('product', 'categories'));
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $product->update($validated);

        $product->categories()->sync($request->categories);

        // Handle new images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $picture = Picture::create([
                    'pictureLink' => $path,
                ]);
                $product->pictures()->attach($picture->id);
            }
        }

        return redirect()->route('products.index');
    }

    public function search(Request $request){
        $search = $request->input('search');
        $categories = $request->input('categories');

        if(Auth::user()->role == "admin"){
            $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($categories, function ($query, $categories) {
                return $query->whereHas('categories', function ($categoryQuery) use ($categories) {
                    $categoryQuery->whereIn('categories.id', $categories);
                }, '=', count($categories));
            })
            ->get();
        }else{
            $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
            })
            ->where('stock', '>', 0)
            ->when($categories, function ($query, $categories) {
                return $query->whereHas('categories', function ($categoryQuery) use ($categories) {
                    $categoryQuery->whereIn('categories.id', $categories);
                }, '=', count($categories));
            })
            ->get();
        }

        $categories = Category::all();

        return view('product.product', compact('products', 'categories'));
    }

    public function addCart(Request $request, $id){
        Cart::firstOrCreate([
            'product_id' => $id,
            'account_id' => Auth::id(),
        ]);
        return redirect()->route('carts.index');
    }
}
