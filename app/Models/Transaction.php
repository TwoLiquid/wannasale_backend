<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property string $id
 * @property string $subscription_id
 * @property int|null $type
 * @property string|null $ext_id
 * @property int|null $amount
 * @property string|null $currency
 * @property string|null $card_type
 * @property string|null $card_last_digits
 * @property int $card_exp_month
 * @property int $card_exp_year
 * @property string|null $card_token
 * @property int $status_code
 * @property string|null $status
 * @property string|null $reason
 * @property string|null $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Subscription $subscription
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasUuid;

    protected $table = 'transactions';

    protected $fillable = [
        'subscription_id',
        'type',
        'ext_id',
        'amount', 'currency',
        'card_type', 'card_last_digits', 'card_exp_month', 'card_exp_year', 'card_token',
        'status_code', 'status', 'reason', 'message'
    ];

    protected $casts = [
        'card_exp_month' => 'integer',
        'card_exp_year' => 'integer',
        'status_code' => 'integer'
    ];

    protected $hidden = [
        'card_token'
    ];

    const TYPE_CARD_ATTACH = 0;
    const TYPE_SUBSCRIPTION_PAYMENT = 1;
    const TYPE_REGULAR_PAYMENT = 2;

    const TYPES = [
        self::TYPE_CARD_ATTACH,
        self::TYPE_SUBSCRIPTION_PAYMENT,
        self::TYPE_REGULAR_PAYMENT
    ];

    //--------------------------------------------------------------------------
    // Relations

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
