<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WidgetEvent
 *
 * @property string $id
 * @property string|null $request_id
 * @property string|null $session_key
 * @property int|null $opened
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Request|null $request
 * @mixin \Eloquent
 * @property string|null $widget_id
 * @property-read \App\Models\Widget|null $widget
 */
class WidgetEvent extends Model
{
    use HasUuid;

    protected $table = 'widget_events';

    protected $fillable = [
        'widget_id', 'request_id', 'session_key', 'opened'
    ];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}
