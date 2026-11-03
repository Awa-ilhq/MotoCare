<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'estimated_price',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'estimated_price' => 'integer',
        ];
    }

    /**
     * URL gambar layanan (mendukung gambar lama di public/images dan upload baru di storage).
     */
    public function getImageUrlAttribute(): string
    {
        if (blank($this->image)) {
            return asset('images/ganti-oli.png');
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return Storage::disk('public')->url($this->image);
    }

    /**
     * Get the bookings for the service.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
