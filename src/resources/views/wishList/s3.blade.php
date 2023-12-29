@extends('layout')
@section('title', 'S3テスト')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
    <h2>S3テスト</h2>
    @if (session('err_msg'))
        <p class="text-danger">{{ session('err_msg') }}
    @endif
        <form action="{{ route('upload') }}" enctype="multipart/form-data" method="POST">
        @csrf 
            <input name="upload_file" type="file" /> 
            <button>アップロード</button>
        </form>
        @if ($path)
        <!-- 画像を表示 -->
            <img src="{{ $path }}">
            <p>
                {{ $path }}
            </p>
            <form method="POST" action="{{ route('delete') }}" onSubmit="return checkDelete()">
                @method('DELETE')
                @csrf
                <td><button type="submit" class="btn btn-primary" onclick="location.href='/wishlist'">削除</button></td>
        @endif
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