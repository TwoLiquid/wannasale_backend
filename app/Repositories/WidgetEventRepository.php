<?php

namespace App\Repositories;

use App\Models\Request;
use App\Models\Widget;
use App\Models\WidgetEvent;
use Illuminate\Database\Eloquent\Collection;

class WidgetEventRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return WidgetEvent::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param string $id
     * @return WidgetEvent|null
     */
    public function findById(string $id) : ?WidgetEvent
    {
        /** @var WidgetEvent|null $widgetEvent */
        $widgetEvent = WidgetEvent::query()
            ->find($id);

        return $widgetEvent;
    }

    /**
     * @param string $sessionKey
     * @return WidgetEvent|null
     */
    public function findBySessionKey(string $sessionKey) : ?WidgetEvent
    {
        /** @var WidgetEvent|null $widgetEvent */
        $widgetEvent = WidgetEvent::query()
            ->where('session_key', '=', $sessionKey)
            ->first();

        return $widgetEvent;
    }

    /**
     * @param Widget $widget
     * @return int
     */
    public function getSeenCount(Widget $widget) : int
    {
        $widgetEvents = WidgetEvent::query()
            ->where('widget_id', '=', $widget->id)
            ->get();

        return count($widgetEvents);
    }

    /**
     * @param Widget $widget
     * @return int
     */
    public function getOpenedCount(Widget $widget) : int
    {
        $widgetEvents = WidgetEvent::query()
            ->where('widget_id', '=', $widget->id)
            ->where('opened', '=', true)
            ->get();

        return count($widgetEvents);
    }

    /**
     * @param Widget $widget
     * @return int
     */
    public function getWithRequestCount(Widget $widget) : int
    {
        $widgetEvents = WidgetEvent::query()
            ->where('widget_id', '=', $widget->id)
            ->where('request_id', '<>', null)
            ->get();

        return count($widgetEvents);
    }

    /**
     * @param Widget $widget
     * @param bool $success
     * @return int
     */
    public function getWithClosedRequest(Widget $widget, bool $success = false) : int
    {
        $widgetEvents = WidgetEvent::query()
            ->where('widget_id', '=', $widget->id)
            ->whereHas('request', function ($query) use($success) {
            $query->where('status', '=', $success === true ? Request::STATUS_CLOSED_SUCCESS : Request::STATUS_CLOSED_FAILURE);
        })->get();

        return count($widgetEvents);
    }

    /**
     * @param Widget $widget
     * @param string $sessionKey
     * @return WidgetEvent
     */
    public function create(
        Widget $widget,
        string $sessionKey
    ) : WidgetEvent {
        /** @var WidgetEvent|null $widgetEvent */
        $widgetEvent = WidgetEvent::create([
            'widget_id'     => $widget->id,
            'session_key'   => $sessionKey
        ]);

        return $widgetEvent;
    }

    /**
     * @param WidgetEvent $widgetEvent
     * @param Request $request
     * @param bool $opened
     * @return WidgetEvent
     */
    public function update(
        WidgetEvent $widgetEvent,
        ?Request $request,
        bool $opened
    )
    {
        $widgetEvent->update([
            'request_id'    => isset($request->id) ? $request->id : null,
            'opened'        => $opened
        ]);

        return $widgetEvent;
    }

    /**
     * @param WidgetEvent $widgetEvent
     * @throws \Exception
     */
    public function delete(WidgetEvent $widgetEvent) : void
    {
        $widgetEvent->delete();
    }
}
