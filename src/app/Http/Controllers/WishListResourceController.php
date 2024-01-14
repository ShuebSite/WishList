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
     * Create a new controller instance.
     * ログインしていないときは画面へ遷移させない
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * wishlist一覧を表示する
     */
    public function index()
    {
        $wishlists = Wishlist::all();

        // dd($wishlists);

        return view('wishList.list', ['wishlists' => $wishlists]);

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
        return redirect(route('wishlist.index'));
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
            return redirect(route('wishlist.index'));
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
            return redirect(route('wishlist.index'));
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
        return redirect(route('wishlist.index'));
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
            return redirect(route('wishlist.index'));
        }
        try {
            // WishListを削除
            Wishlist::destroy($id);
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('wishlist.index'));
    }
}
