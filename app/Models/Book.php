<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    protected $fillable = [
        'code',
        'title',
        'cover',
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this -> belongsToMany(Category::class,'book_categories','book_id','category_id');
    }
}
