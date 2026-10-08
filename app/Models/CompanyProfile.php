<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'tagline',
        'short_description',
        'about_us',
        'vision',
        'mission',
        'values',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'values' => 'array',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('images/logo.png');
    }
}
