<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

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

        if (is_null($wishlist)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('wishlists'));
        }

        // dd($wishlist);

        return view('wishList.detail', ['wishlist' => $wishlist]);

    }
}
