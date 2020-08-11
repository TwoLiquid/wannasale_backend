<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Request;
use App\Models\Widget;
use App\Repositories\RequestRepository;
use App\Repositories\WidgetEventRepository;
use App\Support\Analytics\ItemGraph;
use App\Support\Analytics\WidgetFunnel;
use Illuminate\Database\Eloquent\Collection;

class AnalyticsService {

    /**
     * @param Widget $widget
     * @return WidgetFunnel
     */
    public function getWidgetFunnelInfo(Widget $widget) : WidgetFunnel
    {
        $widgetEventRepo = app(WidgetEventRepository::class);

        $widgetFunnel = new WidgetFunnel(
            $widgetEventRepo->getSeenCount($widget),
            $widgetEventRepo->getOpenedCount($widget),
            $widgetEventRepo->getWithRequestCount($widget),
            $widgetEventRepo->getWithClosedRequest($widget, true),
            $widgetEventRepo->getWithClosedRequest($widget, false)
        );

        return $widgetFunnel;
    }

    /**
     * @param Item $item
     * @return ItemGraph
     */
    public function getItemGraphInfo(
        Item $item
    ) : ItemGraph
    {
        $requestRepo = app(RequestRepository::class);

        $clientOffers = collect();
        $sellerOffers = collect();
        $successfullyOffers = collect();
        $unsuccessfullyOffers = collect();

        $requests = $requestRepo->getClientOffersInfo($item);

        foreach ($requests as $request) {

            if ($request->status == Request::STATUS_CLOSED_SUCCESS) {
                $successfullyOffers->push([
                    'x' => $request->created_at->timestamp,
                    'y' => $request->offered_price
                ]);
            } elseif ($request->status == Request::STATUS_CLOSED_FAILURE) {
                $unsuccessfullyOffers->push([
                    'x' => $request->created_at->timestamp,
                    'y' => $request->offered_price
                ]);
            }

            foreach ($request->proposals_history as $proposal) {
                if ($proposal['author'] === true && $proposal['offered_price'] !== null) {
                    $clientOffers->push([
                        'x' => $proposal['date'],
                        'y' => $proposal['offered_price']
                    ]);
                } elseif ($proposal['author'] === false && $proposal['offered_price'] !== null) {
                    $sellerOffers->push([
                        'x' => $proposal['date'],
                        'y' => $proposal['offered_price']
                    ]);
                }
            }
        }

        $itemGraph = new ItemGraph(
            $clientOffers->sortBy('x')->values()->toArray(),
            $sellerOffers->sortBy('x')->values()->toArray(),
            $successfullyOffers->sortBy('x')->values()->toArray(),
            $unsuccessfullyOffers->sortBy('x')->values()->toArray()
        );

        return $itemGraph;
    }
}