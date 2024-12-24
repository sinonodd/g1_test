<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Column_default extends Model
{
    /** @use HasFactory<\Database\Factories\ColumnDefaultFactory> */
    use HasFactory;

    protected $fillable = [
        'value', 'bg_color', 'column_id'
    ];

    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}
