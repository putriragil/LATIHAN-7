<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data = Product::with('category')->get();
        return view('admin.product.index', compact('data'));
    }

    //
    public function create(){
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    public function store(Request $request){
        $request->validate([
            'tittle' => 'required',
            'category_id' => 'required|numeric',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpg,jpng,jpeg'
        ]);

        $image_file = time() . '.' . $request->image->extension();
        Product::create([
            'category_id => $request->category_id',
            'tittle' => $request->tittle,
            'slug' => str_replace(' ', '-', $request->tittle),
            'harga' => $request->harga,
            'body' => $request->body,
            'image' => $image_file 
        ]);
        $request->image->move(public_path('image'), $image_file);

        return redirect()->route('admin.product.index')->with('succes', 'New Product Hass Been Added');
    }

    public function edit($id){
        $category = Category::all();
        $adata = Product::findorfail($id);
        return view('admin.product.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id){
        $data = Product::find($id);
        $request->validate([
            'tittle' => 'required',
            'category_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'body' => 'required',
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product Hass Been Update');
    }

    public function destory($id){
        $data = Product::fint($id);
        unlink(public_path('image/'. $data->image));
        $data->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product Hass Been Deleted');
    }
}
