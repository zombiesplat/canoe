<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_id',
        'fund_id',
        'date',
        'amount',
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
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cashFlows()
    {
        return $this->hasMany(CashFlow::class);
    }

    /**********************************************************************
     * ATTRIBUTES
     **********************************************************************/

    /**
     * @param $value
     * @return float|int
     */
    public function getAmountAttribute($value)
    {
        if (!empty($value) && is_numeric($value)) {
            return $value / 100;
        }
        return $value;
    }
}
