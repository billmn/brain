<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;

class NotfoundController extends Controller
{
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
    public function index()
    {
        $settings = $this->settingsRepo->all();

        return view('admin.settings.notfound.index', compact('settings'));
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
