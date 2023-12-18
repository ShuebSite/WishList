<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Requests\WishListRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class WishListResourceController extends Controller
{
    /**
     * Display a listing of the resource.]
     * wishlist一覧を表示する
     */
    public function index()
    {
        $wishlists = Wishlist::all();

        // dd($wishlists);

        return view('wishList.list', ['wishlists' => $wishlists]);

    }

    /**
     * Display a listing of the resource.]
     * S3テスト画面を表示する
     */
    public function index_S3()
    {
        $S3FileName = 'bucket/s3filename';
        // if (Storage::disk('s3')->exists($S3FileName)) {
        //     // ...
        //     \Session::flash('err_msg', 'S3 画像あり');
        //     // ファイルの取得
        //     $contents = Storage::get($S3FileName);
        // } else {
        //     \Session::flash('err_msg', 'S3 画像なし');
        // }

        $files = Storage::disk('s3')->files('/'.$S3FileName);
        if ($files) {
            \Session::flash('err_msg', 'S3 画像あり');
            // ファイルの取得
            $contents = Storage::get('/'.$S3FileName);
        } else {
            \Session::flash('err_msg', 'S3 画像なし');
        }


        return view('wishList.s3', [
            'path' => null,
        ]);
    }

    /**
    * S3へのアップロード 
    */
   public function upload(Request $request)
   {
    $S3FileName = 'bucket/s3filename';
    // dd($request);
 
      // アップロードされたファイルを変数に格納
      $upload_file = $request->file('upload_file');
 
      // ファイルがアップロードされた場合
      if(!empty($upload_file)) {
 
         // アップロード先S3フォルダ名 
         $dir = 'bucket';
 
         // バケット内の指定フォルダへアップロード ※putFileはLaravel側でファイル名の一意のIDを自動的に生成してくれます。
        //  $s3_upload = Storage::disk('s3')->putFile('/'.$dir, $upload_file);
        $s3_upload = Storage::disk('s3')->put('/'.$S3FileName, $upload_file);
 
         // ※オプション（ファイルダウンロード、削除時に使用するS3でのファイル保存名、アップロード先のパスを取得します。）
         // アップロードファイルurlを取得
         $s3_url = Storage::disk('s3')->url($s3_upload);

         // アップロードの成功判定
        if ($s3_url) {
            \Session::flash('err_msg', 'アップロードに成功しました。');
        }else {
            \Session::flash('err_msg', 'アップロードに失敗しました。');
        }

        //  TODO: S3にあげたファイルのURLかPathをDBに保存
        
      }

      return view('wishList.s3', [
        'path' => $s3_url,
    ]);
   }

    function download()
    {
        if (Storage::disk('s3')->exists('s3://wishlist-test-bucket/bucket/NrFj9QGz2zku24hLg9jol18ybHTZrc7jfc777lWF.png')) {
            // ...
            \Session::flash('err_msg', 'S3 画像あり');
            // ファイルの取得
            $contents = Storage::get('file.jpg');
        } else {
            \Session::flash('err_msg', 'S3 画像なし');
        }
        return;
    }

    /**
     * Show the form for creating a new resource.
     * wishlist登録を表示する
     */
    public function create()
    {
        return view('wishList.form');
    }

    /**
     * Store a newly created resource in storage.
     * wishlistを登録する
     */
    public function store(WishListRequest $request)
    {
        // dd($request->all());
        // 入力データを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // WishListを登録
            Wishlist::create($inputs);
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash('err_msg', 'WishListを登録しました。');
        return redirect(route('wishlists'));
    }

    /**
     * Display the specified resource.
     * wishlist詳細を表示する
     */
    public function show(string $id)
    {
        $wishlist = Wishlist::find($id);

        // dd($wishlist);

        if (is_null($wishlist)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('wishlists'));
        }

        return view('wishList.detail', ['wishlist' => $wishlist]);

    }

    /**
     * Show the form for editing the specified resource.
     * wishlist編集を表示する
     */
    public function edit(string $id)
    {
        $wishlist = Wishlist::find($id);

        // dd($wishlist);

        if (is_null($wishlist)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('wishlists'));
        }

        return view('wishList.edit', ['wishlist' => $wishlist]);
    }

    /**
     * Update the specified resource in storage.
     * wishlistを更新する
     */
    public function update(WishListRequest $request, string $id)
    {
        // dd($request->all());
        // 入力データを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // WishListを更新
            $wishlist = Wishlist::find($id);
            $wishlist->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $wishlist->save();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash('err_msg', 'WishListを更新しました。');
        return redirect(route('wishlists'));
    }

    /**
     * Remove the specified resource from storage.
     * WishList削除
     */
    public function destroy(string $id)
    {
        // dd($request->all());

        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('wishlists'));
        }
        try {
            // WishListを削除
            Wishlist::destroy($id);
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('wishlists'));
    }
}
