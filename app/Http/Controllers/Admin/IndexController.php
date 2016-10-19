<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sentinel;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $this->pageAttributes['hide_nav'] = true;

        $this->addScript('components/auth.js');

        return $this->loadViewWithScripts('backend.index');
    }

    public function dashboard()
    {
        $this->addScript('components/auth.js');

        $this->setPageTitle("Welcome");

        // dd(Sentinel::getUser()->id);

        return $this->loadViewWithScripts('backend.dashboard');
    }

    public function settings()
    {
        $this->addScript('components/auth.js');

        $this->setPageTitle("Settings");

        // dd(Sentinel::getUser()->id);

        return $this->loadViewWithScripts('backend.settings');
    }
}
