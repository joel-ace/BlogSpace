<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use Sluggable;

    protected $fillable = ['title','cat_id', 'content','slug'];

    public function categories() {
        return $this->hasOne('App\Category', 'id', 'cat_id');
    }

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function lastUpdated() {
        return $this->belongsTo('App\User', 'user_id');
    }

    // Creating a query scope to query both categories and user
    public function scopeManage($query)
    {
        return $query->with('categories', 'users');
    }

    // generate slug using cviebrock/eloquent-sluggable package
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ],
    ];
}
    // Mutator (formats input and runs before saving to DB)

    // Accessor (formats and runs before the data is rendered)

    public function getCreatedAtAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

}
