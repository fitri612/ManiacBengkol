<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user);
        if ($user->is_admin == 1) {
            return view('dashboard.product.index', [
                'products' => Product::latest()->paginate(),
                'categories' => Category::all(),
                'user' => $user,
            ]);
        } else {
            return view('user.product.index', [
                'products' => Product::latest()->paginate(),
                'categories' => Category::all(),
                'user' => $user,
            ]);
        }
    }

    public function index_test()
    {
        # code...
        return view('test.product_list', [
            'products' => Product::latest()->paginate(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|',
            'description' => 'required|max:75',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|numeric'
        ]);


        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('products');
        }

        Product::create($validatedData);
        return redirect('/product')->with('success', 'Create Product Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.product.edit', [
            'products' => Product::find($id),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|',
            'description' => 'required|max:75',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|numeric'
        ]);


        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('products');
        }

        Product::where('id', $id)->update($validatedData);
        return redirect('/product')->with('update', 'update Product Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/product')->with('delete', 'Delete Product Success!');
    }

    public function cart()
    {
        return view('dashboard.cart.index', [
            'products' => Product::latest()->paginate(),
            'categories' => Category::all()
        ]);
    }
}
