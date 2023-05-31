<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    public const BLOG_CATE = 1;
    public const BLOG = 2;
    public const PRODUCT_CATE = 3;
    public const PRODUCT = 4;

    use HasFactory;
    protected $table = "seo";
    protected $guarded = [];
}
