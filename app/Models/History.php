<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class History extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = ['user_id','book_id','date','return_date'];

    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class,'user_id','id');
    }

    public function book(): BelongsTo 
    {
        return $this -> belongsTo(Book::class,'book_id','id');
    }
}
