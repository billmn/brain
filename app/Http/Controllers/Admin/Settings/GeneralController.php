<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;

class GeneralController extends Controller
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

        return view('admin.settings.website.index', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $results = $this->settingsRepo->set($input);

        return back()->withSuccess(trans('admin.settings.message.saved_success'));
    }
}
