<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Widget\CreateFieldRequest;
use App\Http\Requests\Dashboard\Widget\UpdateButtonRequest;
use App\Http\Requests\Dashboard\Widget\UpdateMessageRequest;
use App\Http\Requests\Dashboard\Widget\UpdatePositionRequest;
use App\Http\Requests\Dashboard\Widget\UpdateSettingsRequest;
use App\Http\Requests\Dashboard\Widget\UpdateWindowRequest;
use App\Repositories\SiteRepository;
use App\Repositories\WidgetRepository;
use App\Services\WidgetService;
use App\Support\Models\WidgetDisplaySettings;
use App\Support\Models\WidgetField;
use Illuminate\Http\Request;

class WidgetController extends BaseController
{
    public function updateSettings(
        string $siteId,
        UpdateSettingsRequest $request,
        SiteRepository $siteRepo,
        WidgetRepository $widgetRepo
    )
    {
        $site = $siteRepo->findByIdForVendor($siteId, $this->getVendor());

        if ($site === null) {
            return $this->error('Сайт не найден.', route('dashboard.sites'));
        }

        if ($site->widget === null) {
            return $this->error('Виджет не найден.', route('dashboard.sites'));
        }

        $widgetRepo->updateSettings(
            $site->widget,
            $request->input('enabled'),
            $request->input('on_item_page_only')
        );

        $displaySettings = $site->widget->display_settings;
        $displaySettings->setShowPhone($request->input('display_settings.show_phone'));

        $widgetRepo->updateDisplaySettings(
            $site->widget,
            $displaySettings
        );

        return $this->success('Настройки виджета изменены.');
    }

    /**
     * @param string $siteId
     * @param UpdatePositionRequest $request
     * @param SiteRepository $siteRepo
     * @param WidgetRepository $widgetRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updatePosition(
        string $siteId,
        UpdatePositionRequest $request,
        SiteRepository $siteRepo,
        WidgetRepository $widgetRepo
    )
    {
        $site = $siteRepo->findByIdForVendor($siteId, $this->getVendor());

        if ($site === null) {
            return $this->error('Сайт не найден.', route('dashboard.sites'));
        }

        if ($site->widget === null) {
            return $this->error('Виджет не найден.', route('dashboard.sites'));
        }

        $displaySettings = $site->widget->display_settings;

        $displaySettings->setPosition($request->input('display_settings.position'))
            ->setBottom($request->input('display_settings.bottom'))
            ->setSide($request->input('display_settings.side'));

        $widgetRepo->updateDisplaySettings(
            $site->widget,
            $displaySettings
        );

        return $this->success('Настройки расположения виджета изменены.');
    }

    /**
     * @param string $siteId
     * @param UpdateButtonRequest $request
     * @param SiteRepository $siteRepo
     * @param WidgetRepository $widgetRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateButtonSettings(
        string $siteId,
        UpdateButtonRequest $request,
        SiteRepository $siteRepo,
        WidgetRepository $widgetRepo
    )
    {
        $site = $siteRepo->findByIdForVendor($siteId, $this->getVendor());

        if ($site === null) {
            return $this->error('Сайт не найден.', route('dashboard.sites'));
        }

        if ($site->widget === null) {
            return $this->error('Виджет не найден.', route('dashboard.sites'));
        }

        $displaySettings = $site->widget->display_settings;

        $displaySettings->setButtonText($request->input('display_settings.button_text'))
            ->setButtonColor($request->input('display_settings.button_color'))
            ->setButtonTextColor($request->input('display_settings.button_text_color'))
            ->setButtonWidth($request->input('display_settings.button_width'))
            ->setButtonWidthPercent($request->input('display_settings.button_width_percent') === null ? false : true)
            ->setButtonHeight($request->input('display_settings.button_height'))
            ->setButtonFontSize($request->input('display_settings.button_font_size'));

        $widgetRepo->updateDisplaySettings(
            $site->widget,
            $displaySettings
        );

        return $this->success('Настройки отображения кнопки виджета изменены.');
    }

    /**
     * @param string $siteId
     * @param UpdateWindowRequest $request
     * @param SiteRepository $siteRepo
     * @param WidgetRepository $widgetRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateWindowSettings(
        string $siteId,
        UpdateWindowRequest $request,
        SiteRepository $siteRepo,
        WidgetRepository $widgetRepo
    )
    {
        $site = $siteRepo->findByIdForVendor($siteId, $this->getVendor());

        if ($site === null) {
            return $this->error('Сайт не найден.', route('dashboard.sites'));
        }

        if ($site->widget === null) {
            return $this->error('Виджет не найден.', route('dashboard.sites'));
        }

        $displaySettings = $site->widget->display_settings;

        $displaySettings->setTitleText($request->input('display_settings.title_text'))
            ->setTitleColor($request->input('display_settings.title_color'))
            ->setText($request->input('display_settings.text'))
            ->setBackgroundColor($request->input('display_settings.background_color'))
            ->setCheckboxText($request->input('display_settings.checkbox_text'))
            ->setButtonText($request->input('display_settings.window_button_text'))
            ->setWindowButtonColor($request->input('display_settings.window_button_color'))
            ->setWindowButtonTextColor($request->input('display_settings.window_button_text_color'));

        $widgetRepo->updateDisplaySettings(
            $site->widget,
            $displaySettings
        );

        return $this->success('Настройки общего отображения виджета изменены.');
    }

    public function updateWindowMessage(
        string $siteId,
        UpdateMessageRequest $request,
        SiteRepository $siteRepo,
        WidgetRepository $widgetRepo
    )
    {
        $site = $siteRepo->findByIdForVendor($siteId, $this->getVendor());

        if ($site === null) {
            return $this->error('Сайт не найден.', route('dashboard.sites'));
        }

        if ($site->widget === null) {
            return $this->error('Виджет не найден.', route('dashboard.sites'));
        }

        $displaySettings = $site->widget->display_settings;

        $displaySettings->setMessageText($request->input('display_settings.message_text'))
            ->setMessageTextColor($request->input('display_settings.message_text_color'))
            ->setMessageBackgroundColor($request->input('display_settings.message_background_color'));

        $widgetRepo->updateDisplaySettings(
            $site->widget,
            $displaySettings
        );

        return $this->success('Настройки общего отображения виджета изменены.');
    }

    public function createCustomField(
        string $id,
        CreateFieldRequest $request,
        SiteRepository $siteRepo,
        WidgetService $widgetService
    )
    {
        $vendor = $this->getVendor();

        $site = $siteRepo->findByIdForVendor($id, $vendor);

        $widgetField = new WidgetField(
            $request->input('name'),
            $request->input('title'),
            $request->input('type'),
            $request->input('placeholder'),
            $request->input('options'),
            $widgetService->checkFieldsCount($site->widget)
        );

        if ($widgetService->checkFieldExists(
            $site->widget,
            $widgetField
        ) === true) {
            return $this->error(
                'Поле с таким ID уже добавлено в виджет.'
            );
        }

        $widgetService->addCustomField(
            $site->widget,
            $widgetField
        );

        return redirect()->route('dashboard.sites.view', $id);
    }

    public function deleteCustomField(
        string $id,
        Request $request,
        SiteRepository $siteRepo,
        WidgetService $widgetService
    )
    {
        $vendor = $this->getVendor();

        $site = $siteRepo->findByIdForVendor($id, $vendor);

        $widgetService->deleteCustomField(
            $site->widget,
            $request->input('name')
        );

        return redirect()->route('dashboard.sites.view', $id);
    }
}
