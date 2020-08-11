<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestMessage
 *
 * @property string $id
 * @property string $request_id
 * @property int $author
 * @property string $title
 * @property string $text
 * @property int|null $offered_price
 * @property int $seen
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Request $request
 * @mixin \Eloquent
 */
class RequestMessage extends Model
{
    use HasUuid;

    protected $table = 'requests_messages';

    protected $fillable = [
        'request_id', 'author', 'title', 'text', 'seen', 'offered_price'
    ];

    protected $casts = [
        'author' => 'boolean',
        'seen' => 'boolean'
    ];

    //--------------------------------------------------------------------------
    // Relations

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
