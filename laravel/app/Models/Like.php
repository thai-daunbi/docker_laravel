<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type'
    ];

    public function likeable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}

// Schema::create('likes', function (Blueprint $table) {
//     $table->id();
//     $table->unsignedBigInteger('user_id');
//     $table->unsignedBigInteger('post_id');
//     $table->enum('type', ['like', 'dislike']);
//     $table->timestamps();

//     $table->foreign('user_id')->references('id')->on('users');
//     $table->foreign('post_id')->references('id')->on('posts');
// });

