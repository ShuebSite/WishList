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
}
