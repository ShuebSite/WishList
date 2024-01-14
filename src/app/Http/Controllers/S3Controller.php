<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Requests\WishListRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class S3Controller extends Controller
{
   
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

   /**
    * S3のファイルをダウンロード 
    */
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
    * S3のファイルディレクトリを削除 
    */
    public function deleteS3Directory() {
        $S3FileName = 'bucket/s3filename';

        // $directories = Storage::disk('s3')->directories('bucket');
        // dd($directories);

        $s3_delete = Storage::disk('s3')->deleteDirectory($S3FileName);

        \Session::flash('err_msg', '削除しました。');

        return view('wishList.s3', [
            'path' => null,
        ]);
    }
}
