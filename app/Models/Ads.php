<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'start_date',
        'category_id',
        'tag_id',
        'advertiser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'advertiser');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
