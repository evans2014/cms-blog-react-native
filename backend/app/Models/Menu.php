<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'url',
        'page_id',
        'post_overview_id',
        'order'
    ];

    // Релация към страница
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    // (опционално) релация към постове
    public function postOverview()
    {
        return $this->belongsTo(Post::class, 'post_overview_id');
    }
}