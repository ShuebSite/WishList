@extends('layout')
@section('title', 'WishList一覧')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h2>WishList一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">{{ session('err_msg') }}
        @endif
        <table class="table table-striped">
            <tr>
                <th>番号</th>
                <th>タイトル</th>
                <th>日付</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($wishlists as $wishlist)
            <tr>
                <td>{{ $wishlist->id }}</td>
                <td><a href="/wishlist/{{ $wishlist->id }}">{{ $wishlist->title }}</a></td>
                <td>{{ $wishlist->updated_at }}</td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/wishlist/edit/{{ $wishlist->id }}'">編集</button></td>
                <form method="POST" action="{{ route('wishlist.destroy', $wishlist->id) }}" onSubmit="return checkDelete()">
                @method('DELETE')
                @csrf
                <td><button type="submit" class="btn btn-primary" onclick="location.href='/wishlist'">削除</button></td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
function checkDelete() {
    if (window.confirm('削除してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}
</script>
@endsection