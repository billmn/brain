<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Services\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\FormRepository;

class PagesController extends Controller
{
    protected $theme;
    protected $pageRepo;
    protected $formList;
    protected $templates;

    public function __construct(PageRepository $pageRepo, FormRepository $formRepo, Theme $theme)
    {
        parent::__construct();

        $this->theme = $theme;
        $this->pageRepo = $pageRepo;

        $this->formList = [
            false => trans('admin.pages.default_form'),
        ] + $formRepo->enabled()->pluck('name', 'id')->toArray();

        $this->templates = [
            false => trans('admin.pages.default_tpl'),
        ] + $this->theme->getTemplates();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->pageRepo->basicTree();
        }

        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page = $this->pageRepo->model();
        $formList = $this->formList;
        $statusList = $this->pageRepo->getStatusList();
        $templatesList = $this->templates;

        $page->parent_id = $request->get('parent_id');

        return view('admin.pages.form', compact('page', 'formList', 'statusList', 'templatesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PageCreateRequest $request)
    {
        $input = $request->all();
        $input['custom_excerpt'] = $request->has('custom_excerpt');

        $input = $this->fixNullableValues($input);
        $page = $this->pageRepo->create($input);

        return redirect()->route('pages.edit', $page->id)->withSuccess(trans('admin.pages.message.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->pageRepo->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageRepo->find($id);
        $formList = $this->formList;
        $statusList = $this->pageRepo->getStatusList();
        $templatesList = $this->templates;

        return view('admin.pages.form', compact('page', 'formList', 'statusList', 'templatesList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PageUpdateRequest $request, $id)
    {
        $input = $request->all();
        $input['custom_excerpt'] = $request->has('custom_excerpt');

        $input = $this->fixNullableValues($input);
        $page = $this->pageRepo->update($id, $input);

        return back()->withSuccess(trans('admin.pages.message.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $node = $this->pageRepo->delete($id);

        return $id;
    }

    /**
     * Move the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function move(Request $request)
    {
        $moved = $this->pageRepo->find($request->get('moved'));
        $target = $this->pageRepo->find($request->get('target'));
        $position = $request->get('position');

        return $this->pageRepo->move($position, $moved, $target);
    }

    /**
     * I cannot use "null" as select's default option.
     * This method fix nullable values on a form submission.
     *
     * @param  array  $input
     * @return array
     */
    protected function fixNullableValues(array $input)
    {
        if (isset($input['template']) and $input['template'] == false) {
            $input['template'] = null;
        }

        if (isset($input['form_id']) and $input['form_id'] == false) {
            $input['form_id'] = null;
        }

        return $input;
    }
}
