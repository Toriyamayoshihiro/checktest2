@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h1>商品一覧</h1>
  </div>
  <form class="form" action="/products/search" method="get">
    @csrf
    <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{request('keyword')}}">
    <input class="search-form__search-btn btn" type="submit" value="検索">
 </form>
</div>


 <form action="/products" method="get">
   @csrf
    <span class="form__label--item">価格順で表示</span>
     <select name="price" class="select" onchange="this.form.submit()">
        <option value="0">価格で並べ替え</option> 
        <option value="高い順に表示" {{ $price ===  '高い順に表示' ? 'selected': '' }}>高い順に表示</option>
        <option value="低い順に表示" {{ $price ===  '低い順に表示' ? 'selected': '' }}>低い順に表示</option>
     </select>
</form>
@if(!empty($price))
<form action="/products" method="get"> 
   @csrf
   <span>{{$price}}</span>
  <button type="submit" class="recet" >×</button>
</form>
@endif
<div class="register__link">
    <a class="register__button-submit" href="/products/register">商品追加</a>   
</div>

@foreach($products as $product)
<a href="/products/{{$product->id}}" class="card">
<div>
    
      <img src="{{asset('storage/' . $product->image)}}">
      <p>{{$product->name}}</p>
      <p>￥{{$product->price}}</p>
    </button>
</a>   
</div>
@endforeach
{{ $products->links() }}
@endsection


