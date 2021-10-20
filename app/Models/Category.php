<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';


    // protected $with = [
    //     'categories'
    // ];
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','category_id', 'name', 'slug', 'image', 'description','return_policy', 'status', 'show_on_homepage'];

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'category_id',
    ];

    protected static function boot()
    {
        parent::boot();
        // Order by sort order ASC
        static::addGlobalScope('sort_order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function category(){

        return $this->belongsTo(Category::class ,'category_id','id');

    }

    public function categories(){
        return $this->hasMany(Category::class ,'category_id','id');
    }

    public function getParentCategoriesAttribute()
    {
        $parents = collect([]);

        $parentCategory = $this->category;

        while($parentCategory != null) {
            $parents->push($parentCategory->name);
            $parentCategory = $parentCategory->category;
        }

        return $parents->reverse()->add($this->name)->implode(' > ');
    }

    public function coupons()
    {
        return $this->belongsToMany('App\Models\Coupon','coupon_categories')->withPivot(['status']);
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','product_categories');
    }
}
