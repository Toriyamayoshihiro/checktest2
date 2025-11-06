@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<h1>商品登録</h1>

<form action="/products/register/store" method="post" enctype="multipart/form-data">
    @csrf
<div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">商品名</span>
        <span class="form__label--required">必須</span>
         <div class="form__input--text">
          <input type="text" name="name" value="{{old('name')}}" placeholder="商品名を入力">
        </div>
     </div>
</div>
@error('name')
   <p class="error-message">{{ $message }}</p>
@enderror
<div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">値段</span>
        <span class="form__label--required">必須</span>
         <div class="form__input--text">
          <input type="text" name="price" value="{{old('price')}}" placeholder="値段を入力">
        </div>
     </div>
</div>
@error('price')
  <p class="error-message">{{$message}}</p>
@enderror
<div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">商品画像</span>
        <span class="form__label--required">必須</span>
         <div class="form__input--text">
          <input type="file" name="image" id="image">
        </div>
     </div>
</div>
@error('image')
  <p class="error-message">{{$message}}</p>
@enderror
<div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">季節</span>
        <span class="form__label--required">必須</span>
        <span class="form__label--sentence">複数選択可</span>
         <div class="form__input--text">
            <label>
                @foreach($seasons as $season)
                <input type="checkbox" name="season_id[]"  value="{{$season->id}}" {{ is_array(old("season_id")) && in_array("$season->id", old("season_id"), true)? ' checked' : '' }}>
                <span class="contact-form__season-text">{{$season->name}}</span>
                @endforeach
            </label>
        </div>
     </div>
</div>
@error('season_id')
  <p class="error-message">{{$message}}</p>
@enderror
<div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">商品説明</span>
        <span class="form__label--required">必須</span>
         <div class="form__input--text">
          <textarea name="description" cols="40" rows="3" placeholder="商品の説明を入力">{{old('description')}}</textarea>
        </div>
     </div>
</div>
@error('description')
  <p class="error-message">{{$message}}</p>
@enderror

<input  type="submit" value="登録" name="send">
</form>
<form action="/products" method="get">
    @csrf
  <input type="submit" value="戻る" >
</form>
@endsection
