<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    //
    protected $fillable = ['content'];

    /**
     * 获得发布该微博的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
       return $this->belongsTo(User::class);
    }






}
