<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Services\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;

class MaintenanceController extends Controller
{
    protected $website;
    protected $settingsRepo;

    public function __construct(SettingsRepository $settingsRepo)
    {
        parent::__construct();

        $this->settingsRepo = $settingsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        $settings = $this->settingsRepo->all();
        $statusList = $website->getStatusList();

        return view('admin.settings.maintenance.index', compact('settings', 'statusList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = $this->settingsRepo->set($request->except('_token'));

        return back()->withSuccess(trans('admin.settings.message.saved_success'));
    }
}
