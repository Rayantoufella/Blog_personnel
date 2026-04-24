<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Article extends Model
{
    protected $fillable = ['titre', 'contenu', 'statut', 'date_publication', 'user_id', 'category_id'];

    protected $casts = [
        'date_publication' => 'datetime',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);

    }
}
