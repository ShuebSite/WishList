<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        dd($request->all());
        // 入力データを受け取る
        $inouts = $request->all();

        \DB::beginTransaction();
        try {
            // WishListを登録
            WishList::create($inputs);
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash('err_msg', 'ブログを登録しました。');
        return redirect(route('wishlists'));
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
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * wishlistを更新する
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
        // 入力データを受け取る
        $inouts = $request->all();

        \DB::beginTransaction();
        try {
            // WishListを更新
            $wishlist = WishList::find($inputs['id']);
            WishList::fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $wishlist->save();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash('err_msg', 'ブログを更新しました。');
        return redirect(route('wishlists'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
