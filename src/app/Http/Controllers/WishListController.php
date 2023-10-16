<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * ブログ一覧を表示する
     * 
     *  @return view
    */
    public function showList()
    {
        return view('wishList.list');

    }
}
