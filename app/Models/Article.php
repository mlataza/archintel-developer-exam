<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image', 'link', 'content',
        'status', 'writer_id', 'editor_id', 'company_id'
    ];

    protected $casts = [
        'status' => ArticleStatus::class
    ];

    public function getImageUrlAttribute(): string 
    {
        return Storage::url($this->image);
    }

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
