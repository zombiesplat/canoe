<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Fund extends Model
{
    use HasFactory;

    private $isRedacted = false;

    const TYPES = [
        'HF',
        'PL',
        'VC',
        'RE',
        'PC',
    ];

    protected $fillable = [
        'name',
        'type',
        'inception_date',
        'description',
    ];

    protected $casts = [
        'inception_date' => 'date:Y-m-d',
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

    /**********************************************************************
     * METHODS
     **********************************************************************/

    /**
     * Redact the fillable fields that are not in the white list
     *
     * @return $this
     */
    public function setRedacted(bool $value)
    {
        $this->isRedacted = $value;
        return $this;
    }

    /**********************************************************************
     * ATTRIBUTES
     **********************************************************************/

    /**
     * @param $value
     * @return string
     */
    public function getInceptionDateAttribute($value)
    {
        if ($this->isRedacted) {
            return str_repeat('*', strlen($value));
        }
        return Date::parse($value)->format('Y-m-d');
    }

    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        if ($this->isRedacted) {
            return str_repeat('*', strlen($value));
        }
        return $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        if ($this->isRedacted) {
            return str_repeat('*', strlen($value));
        }
        return $value;
    }
}
