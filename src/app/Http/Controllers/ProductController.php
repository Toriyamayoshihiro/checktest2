<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->price === '高い順に表示'){
            $products = Product::orderBy('price','desc')->Paginate(6);
        }elseif($request->price === '低い順に表示'){
                $products = Product::orderBy('price','asc')->Paginate(6);
        }else{
            $products = Product::Paginate(6);
        }
        $price = $request->price;
            return view('products',compact('products','price'));
        
    }
    public function detail($productId)
    {
        $product=Product::with('seasons')->find($productId);
        $seasons=Season::all();

            return view('detail', compact('product','seasons'));
    }
    public function search(Request $request)
    {
        $query = Product::query();
        if(!empty($request->keyword)) {
            $query->where('name' ,'like', '%' . $request->keyword . '%');
            }
        $products = $query->Paginate(6);
        $price = $request->input('price');
        return view('products', compact('products','price'));
    }
    public function register()
    {
        $seasons = Season::all();
        return view('register',compact('seasons'));
    }
    public function store(ProductRequest $request)
    {
    $productData = $request->only(['name','price','discription']);
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images','public');
            $productData['image'] = $path;
        }
        $product= Product::create($productData);
        $product->seasons()->sync($request->season_id);
        return redirect('/products',);
    }
    public function update(ProductRequest $request ,$productId)
    {
        
        $product = Product::find($productId);
        $productData = $request->only(['name','price','discription']);
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images','public');
            $productData['image'] = $path;
        }
        $product->update($productData);
        $product->seasons()->sync($request->season_id);
        return redirect('/products',);
    }
    public function delete($productId)
    {
        Product::find($productId)->delete();
        return redirect('/products',);
    }
}
