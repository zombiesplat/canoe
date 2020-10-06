<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_id',
        'date',
        'return',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    /**********************************************************************
     * RELATIONSHIPS
     **********************************************************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
