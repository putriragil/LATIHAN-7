<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controllers;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{
    public function index(){
        $data = Catrgory::all();
        return view('admin.category.index', compact('data'));
    }

    public function store(Request $request){
       $request->validate([
        'tittle_category' => 'required|unique:categories'
       ]);
       Category::create([
        'tittle_category' => request->tittle_category,
        'slug_category' => str_replace(' ', '_', $request->tittle_category)
       ]);
       return redirect()->route('admin.category.index')->with('success', 'Category Hass Been Added');
    }

    public function destory($id){
        Category::find($id)->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category Hass Been Deleted');
    }
}