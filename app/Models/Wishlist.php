<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\WishListsTableFactory;

class Wishlist extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'wishlists';

    // 可変項目
    protected $fillable = 
    [
        'title',
        'content'
    ];

    protected static function newFactory()
    {
        return WishListsTableFactory::new();
    }
}
