<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Warehouse;


class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function sutcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickpoint()
    {
        return $this->belongsTo(Piceup_point::class, 'pickup_point');
    }
}
