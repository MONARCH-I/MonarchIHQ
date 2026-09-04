<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaiMessage extends Model
{
    protected $table = 'mai_messages';

    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'reasoning',
        'sql',
        'results_count',
        'results_preview',
    ];

    protected $casts = [
        'results_preview' => 'array',
    ];

    protected $touches = ['conversation'];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(MaiConversation::class, 'conversation_id');
    }
}
