<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'permission',
        'description',
    ];

    protected $casts = [
        'permission' => 'json',
    ];

    /**********************************************************************
     * RELATIONSHIPS
     **********************************************************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function funds()
    {
        return $this->hasManyThrough(Fund::class, Investment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function cashFlows()
    {
        return $this->hasManyThrough(CashFlow::class, Investment::class);
    }

    /**********************************************************************
     * METHODS
     **********************************************************************/

    /**
     * @param Fund $fund
     * @return bool
     */
    public function canViewFund(Fund $fund)
    {
        return in_array($fund->type, $this->permission);
    }
}
