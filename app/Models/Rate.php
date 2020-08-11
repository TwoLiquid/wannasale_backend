<?php

namespace App\Models;

use App\Models\Presenters\RatePresenter;
use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscription
 *
 * @property string $id
 * @property string $name
 * @property int $price
 * @property int $default
 * @mixin \Eloquent
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 */
class Rate extends Model
{
    use HasUuid;

    protected $table = 'rates';

    protected $fillable = [
        'name', 'price', 'default'
    ];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}
