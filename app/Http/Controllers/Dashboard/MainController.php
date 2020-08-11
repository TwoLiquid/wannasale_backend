<?php

namespace App\Http\Controllers\Dashboard;

class MainController extends BaseController
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function home()
    {
        return redirect()->route('dashboard.sites');
    }
}
