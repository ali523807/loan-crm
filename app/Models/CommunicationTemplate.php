<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationTemplate extends Model
{
    /** @use HasFactory<\Database\Factories\CommunicationTemplateFactory> */
    use HasFactory;

    public const CHANNELS = [
        'email' => 'Email',
        'whatsapp' => 'WhatsApp',
    ];

    protected $fillable = [
        'name',
        'type',
        'channel',
        'subject',
        'body',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}
