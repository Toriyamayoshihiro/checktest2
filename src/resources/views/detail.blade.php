@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<form action="/products/{{$product->id}}/update" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <img src="{{asset('storage/' . $product->image)}}" name="image" alt="">
    <span class="form__label--item">商品名</span>
    <input type="text" name="name" value="{{$product->name}}" placeholder="商品名を入力">
    @error('name')
          <p class="error-message">{{ $message }}</p>
    @enderror
    <span class="form__label--item">値段</span>
    <input type="text" name="price" value="{{$product->price}}" placeholder="値段を入力">
    @error('price')
          <p class="error-message">{{ $message }}</p>
    @enderror
    <span>季節</span>
    @foreach($seasons as $season)
    <input type="checkbox" name="season_id[]" value="{{$season->id}}" {{$product->seasons->contains($season->id) ? 'checked' :'' }} >
     <span>{{$season->name}}</span>
     @endforeach
     @error('season_id')
          <p class="error-message">{{ $message }}</p>
    @enderror
    <label for="image">ファイルを選択</label>
    <input type="file" name="image" id="image">
    @error('image')
          <p class="error-message">{{ $message }}</p>
    @enderror
    <span>商品説明</span>
    <textarea name="description" cols="40" rows="3" placeholder="商品の説明を入力">{{$product->description}}</textarea>
    @error('description')
          <p class="error-message">{{ $message }}</p>
    @enderror
    <button class="update-form__button-submit" type="submit">変更を保存</button>
</form>
<form action="/products" method="get">
    @csrf
  <input type="submit" value="戻る" >
</form>
<form action="/products/{{$product->id}}/delete" method="post">
   @method('DELETE')
    @csrf
    <button class="delete-form__button-submit" type="submit">
      <img src="{{asset('images/trash-icon.png')}}" alt="削除" style="width: 24px; height: 24px;">
    </button>
</form>
@endsection