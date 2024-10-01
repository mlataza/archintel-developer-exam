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

    public function canEdit(User $user): bool
    {
        // All editors can edit any article
        if ($user->is_editor) {
            return true;
        }

        // Writer can only edit the articles that he/she created and 
        // at FOR_EDIT status
        return $this->status === ArticleStatus::FOR_EDIT && $this->writer_id === $user->id;
    }

    public function canPublish(User $user): bool 
    {
        // Only editor can publish and the article is 'FOR_EDIT'
        return $user->is_editor && $this->status === ArticleStatus::FOR_EDIT;
    }

    public static function canCreate(User $user): bool
    {
        // Only writers can create articles
        return !$user->is_editor;
    }
}
