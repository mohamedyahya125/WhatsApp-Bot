<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
        'max_capacity',
        'status',
        'duration',
    ];
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
    public function employee(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
