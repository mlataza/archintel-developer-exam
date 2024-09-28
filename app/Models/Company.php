<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CompanyStatus;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo', 'name', 'status'
    ];

    protected $casts = [
        'status' => CompanyStatus::class
    ];

    public function getLogoUrlAttribute(): string 
    {
        return Storage::url($this->logo);
    }

    public function getIsActiveAttribute(): bool 
    {
        return $this->status === CompanyStatus::ACTIVE;
    }
}
