<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groupe extends Model
{
    /** @use HasFactory<\Database\Factories\GroupeFactory> */
    use HasFactory;

    protected $fillable = ['title'];
    
    public function columns(): HasMany {
        return $this->hasMany(Column::class);
    }
}
