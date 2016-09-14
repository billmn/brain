<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\Theme;
use App\Http\Controllers\Controller;

class LabelsController extends Controller
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = trans('labels');
        $values = settings('labels');
        $themeName = $this->theme->getActive();
        $themeValues = $this->theme->getLabelsValues();

        foreach ($this->theme->getLabels() as $labelName => $labelInfo) {
            $labels["{$themeName}::{$labelName}"] = $labelInfo;
        }

        foreach ($this->theme->getLabelsValues() as $name => $value) {
            $values["{$themeName}::{$name}"] = $value;
        }

        return view('admin.labels.index', compact('labels', 'values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = collect($request->except('_token'));
        $themeName = $this->theme->getActive();
        $themeLabels = [];

        $labels = $input->filter(function($value, $key) {
            return str_contains($key, '::') === false;
        });

        foreach ($input->diffKeys($labels) as $key => $value) {
            $themeLabels[str_replace("{$themeName}::", '', $key)] = $value;
        }

        settings(['labels' => $labels]);
        $this->theme->setLabelsValues($themeLabels);

        return back()->withSuccess(trans('admin.labels.message.save_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
