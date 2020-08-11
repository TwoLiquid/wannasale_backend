<?php

namespace App\Services;

use App\Models\Widget;
use App\Repositories\WidgetRepository;
use App\Support\Models\WidgetField;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;

class WidgetService
{
    /**
     * @param Widget $widget
     * @param string $url
     * @return bool
     */
    public function displayedOnPage(Widget $widget, string $url): bool
    {
        if ($widget->enabled === false) {
            return false;
        }

        if ($widget->on_item_page_only === false) {
            return true;
        }

        $items = $widget->site->items;
        if (count($items) == 0) {
            return false;
        }

        foreach ($items as $item) {
            if ($item->urls !== null) {
                foreach ($item->urls as $itemUrl) {
                    if (preg_match('^' . trim($itemUrl, '*') . '^', $url)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param Widget $widget
     * @param string $origin
     * @return bool
     */
    public function checkDomainOrigin(Widget $widget, string $origin) : bool
    {
        $siteUrls = $widget->site->urls;

        foreach ($siteUrls as $url) {
            if (preg_match('^' . trim($url, '*') . '^', $origin)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Widget $widget
     * @param string $url
     * @return Collection|null
     */
    public function getItemsForWidget(
        Widget $widget,
        string $url
    ): ?Collection
    {
        $items = $widget->site->items;
        if (count($items) == 0) {
            return null;
        }

        $matchedItems = new Collection();
        foreach ($items as $item) {
            if ($item->urls !== null) {
                foreach ($item->urls as $itemUrl) {
                    if (preg_match('^' . trim($itemUrl, '*') . '^', $url)) {
                        $matchedItems->add($item);
                    }
                }
            }
        }

        if (count($matchedItems) == 0) {
            return null;
        }

        return new Collection($matchedItems);
    }

    /**
     * @return string
     */
    public function makeWidgetSessionKey() : string
    {
        return str_random(16);
    }

    /**
     * @param Widget $widget
     * @param WidgetField $widgetField
     * @return bool
     */
    public function checkFieldExists(
        Widget $widget,
        WidgetField $widgetField
    ) : bool
    {
        $customFields = $widget->custom_fields;

        if ($customFields === null) {
            return false;
        }

        if ($customFields->contains('name', $widgetField->getName()) === false) {
            return false;
        }

        return true;
    }

    /**
     * @param Widget $widget
     * @return int
     */
    public function checkFieldsCount(
        Widget $widget
    ) : int
    {
        $customFields = $widget->custom_fields;

        return count($customFields);
    }

    /**
     * @param Widget $widget
     * @param WidgetField $widgetField
     */
    public function addCustomField(
        Widget $widget,
        WidgetField $widgetField
    ) : void
    {
        $widgetRepo = app(WidgetRepository::class);

        $customFields = $widget->custom_fields;

        if ($customFields === null) {
            $customFields = new Collection();
        }

        $customFields->push($widgetField);

        $widgetRepo->updateCustomFields(
            $widget,
            $customFields
        );
    }

    /**
     * @param Widget $widget
     * @param string $name
     */
    public function deleteCustomField(
        Widget $widget,
        string $name
    ) : void
    {
        $widgetRepo = app(WidgetRepository::class);

        $customFields = $widget->custom_fields;

        if ($customFields === null) {
            $customFields = new Collection();
        }

        foreach ($customFields as $k => $customField) {
            if ($customField->getName() == $name) {
                $customFields->forget($k);
            }
        }

        $widgetRepo->updateCustomFields(
            $widget,
            $customFields
        );
    }
}