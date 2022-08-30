<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAsset extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
