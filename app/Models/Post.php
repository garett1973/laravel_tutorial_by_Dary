<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'excerpt',
        'body',
        'image',
        'is_published',
        'minutes_to_read',
    ];

//    protected $table = 'posts'; // optional, if you want to specify table name

//    protected $primaryKey = 'title'; // optional, if you want to change primary key, default is id

//    protected $timestamps = false; // optional, if you want to disable timestamps, default is true

//    protected $dateTime = 'Y-m-d H:i:s'; // optional, if you want to change date time format, default is Y-m-d H:i:s

//    protected $connection = 'sqlite'; // optional, if you want to change connection, default is mysql

//    protected $attributes = [
//        'is_published' => false,
//    ]; // optional, if you want to set default values

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meta()
    {
        return $this->hasOne(PostMeta::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}


