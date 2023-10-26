@extends('layout')
@section('title', 'WishList一覧')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>WishList一覧</h2>
        <table class="table table-striped">
            <tr>
                <th>記事番号</th>
                <th>日付</th>
                <th>タイトル</th>
                <th>内容</th>
            </tr>
            @foreach($wishlists as $wishlist)
            <tr>
                <td>{{ $wishlist->id }}</td>
                <td>{{ $wishlist->updated_at }}</td>
                <td>{{ $wishlist->title }}</td>
                <td>{{ $wishlist->content }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
