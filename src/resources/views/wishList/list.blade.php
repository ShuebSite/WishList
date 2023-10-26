@extends('layout')
@section('title', 'WishList一覧')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>WishList一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">{{ session('err_msg') }}
        @endif
        <table class="table table-striped">
            <tr>
                <th>記事番号</th>
                <th>タイトル</th>
                <th>日付</th>
            </tr>
            @foreach($wishlists as $wishlist)
            <tr>
                <td>{{ $wishlist->id }}</td>
                <td><a href="/wishlist/{{ $wishlist->id }}">{{ $wishlist->title }}</a></td>
                <td>{{ $wishlist->updated_at }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection