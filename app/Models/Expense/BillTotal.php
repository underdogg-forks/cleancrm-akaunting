<?php

namespace App\Models\Expense;

use App\Models\Model;
use App\Models\Setting\Tax;
use App\Traits\DateTime;

class BillTotal extends Model
{
    use DateTime;

    protected $table = 'bill_totals';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['title'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'bill_id', 'code', 'name', 'amount', 'sort_order'];

    public function bill()
    {
        return $this->belongsTo('App\Models\Expense\Bill');
    }

    /**
     * Convert amount to double.
     *
     * @param string $value
     */
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (float) $value;
    }

    /**
     * Get the formatted name.
     *
     * @return string
     */
    public function getTitleAttribute()
    {
        $title = $this->name;

        $percent = 0;

        switch ($this->code) {
            case 'discount':
                $title = trans($title);
                $percent = $this->bill->discount;

                break;
            case 'tax':
                $rate = Tax::where('name', $title)->value('rate');

                if (!empty($rate)) {
                    $percent = $rate;
                }

                break;
        }

        if (!empty($percent)) {
            $title .= ' (';

            if (setting('general.percent_position', 'after') == 'after') {
                $title .= $percent.'%';
            } else {
                $title .= '%'.$percent;
            }

            $title .= ')';
        }

        return $title;
    }
}
