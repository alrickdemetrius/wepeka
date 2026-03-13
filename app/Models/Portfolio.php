<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'title',
        'portfolio_category_id',
        'description',
        'is_featured'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function images() {
        return $this->hasMany(PortfolioImage::class);
    }

    public function category() {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }
}