<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhatsappCustomer extends Model
{
    protected $fillable = [
        'business_id',
        'phone_number',
        'name',
        'last_interaction',
    ];
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
