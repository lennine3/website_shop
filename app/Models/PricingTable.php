<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class PricingTable extends Model
{

    protected $table = 'pricing_table';
    protected $guarded = [];
}
