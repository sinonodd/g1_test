<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Column extends Model
{
    /** @use HasFactory<\Database\Factories\ColumnFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'groupe_id', 'type'
    ];

    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class);
    }

    public function column_default(): HasMany {
        return $this->hasMany(Column_default::class);
    }

    public function value(): HasMany {
        return $this->hasMany(Value::class);
    }
}
