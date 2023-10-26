@extends('layout')
@section('title', 'WishList詳細')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>{{ $wishlist->title }}</h2>
        <span>作成日：{{ $wishlist->created_at }}</span>
        <span>更新日：{{ $wishlist->updated_at }}</span>
        <p>{{ $wishlist->content }}</p>

    </div>
</div>
@endsection
