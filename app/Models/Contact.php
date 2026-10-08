<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'whatsapp',
        'email',
        'maps_embed',
        'instagram',
        'tiktok',
        'facebook',
        'operational_hours',
        'custom_links',
    ];

    protected function casts(): array
    {
        return [
            'custom_links' => 'array',
        ];
    }

    public function getCleanWhatsappAttribute(): string
    {
        $clean = preg_replace('/[^0-9]/', '', $this->whatsapp ?? '');
        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        }
        return $clean;
    }

    public static function getPlatformLogo(string $platform): string
    {
        return match (strtolower($platform)) {
            'whatsapp' => asset('images/whatsapp.png'),
            'grabfood' => asset('images/grabfood.png'),
            'gofood' => asset('images/gofood.png'),
            'shopee' => asset('images/shopee.png'),
            'tiktok' => asset('images/tiktok.png'),
            default => asset('images/logo.png'),
        };
    }
}
