<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Requests\WishListRequest;

class WishListController extends Controller
{
    /**
     * wishlist一覧を表示する
     * 
     *  @return view
    */
    public function showList()
    {
        $wishlists = Wishlist::all();

        // dd($wishlists);

        return view('wishList.list', ['wishlists' => $wishlists]);

    }

    /**
     * wishlist詳細を表示する
     * 
     *  @return view
    */
    public function showDetail($id)
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
     * wishlist登録を表示する
     * 
     *  @return view
    */
    public function showCreate()
    {
        return view('wishList.form');
    }

    /**
     * wishlist編集を表示する
     * 
     *  @return view
    */
    public function showEdit($id)
    {
        $wishlist = Wishlist::find($id);

        // dd($wishlist);

        if (is_null($wishlist)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('wishlists'));
        }

        return view('wishList.edit', ['wishlist' => $wishlist]);

    }

    // /**
    //  * wishlistを登録する
    //  * 
    //  *  @return view
    // */
    // public function exeStore(WishListRequest $request)
    // {
    //     // 入力データを受け取る
    //     $inouts = $request->all();
    //     // WishListを登録
    //     WishList::create($inputs);
    //     \Session::flash('err_msg', 'WISHLISTを登録しました。');
    //     return redirect(route('wishlists'));
    // }
}