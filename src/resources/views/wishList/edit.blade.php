@extends('layout')
@section('title', 'WishList編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>WishList編集フォーム</h2>
        <form mehod="POST" action="route('edit')" onSubmit="return checkSubmit()">
        @csrf
            <input type="hidden" name="id" value="{{ $wishlist->id }}">
            <div class="form-group">
                <label for="title">
                    タイトル
                </label>
                <input id="title" name="title" class="form-control" value="{{ $wishlist->title }}" type="text">
                @if ($errors->has('title'))
                <div class="text-danger">
                    {{ $errors->first('title') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">
                    本文
                </label>
                <textarea id="content" name="content" class="form-control" rows="4">{{ $wishlist->content }}</textarea>
                @if ($errors->has('content'))
                <div class="text-danger">
                    {{ $errors->first('content') }}
                </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('wishlists') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit() {
    if (window.confirm('更新してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}
</script>
@endsection