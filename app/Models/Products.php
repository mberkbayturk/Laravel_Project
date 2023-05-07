<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'photo',
    ];

    public function category() {
        return $this->belongsTo(Categories::class,'category_id','id');
    }
    public function ratings() {
        return $this->hasMany(Rating::class,'product_id','id');
    }

    public function totalRatings()
    {
        return $this->ratings()->sum('stars_rated');
    }

}
