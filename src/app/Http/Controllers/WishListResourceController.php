<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Requests\WishListRequest;

class WishListResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $a="a";
        dd($a);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        // return 'hello ri';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     */
    public function edit(string $id)
    {
        //
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
        // return 'ori';
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
        // return 'ori';
    }
}
