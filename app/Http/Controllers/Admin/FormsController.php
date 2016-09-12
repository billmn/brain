<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FormRepository;

class FormsController extends Controller
{
    protected $formRepo;

    public function __construct(FormRepository $formRepo)
    {
        parent::__construct();

        $this->formRepo = $formRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = $this->formRepo->all();

        return view('admin.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->formRepo->model();
        $form->enabled = true;

        return view('admin.forms.form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\FormCreateRequest $request)
    {
        $input = $request->all();
        $input['enabled'] = $request->has('enabled');

        $form = $this->formRepo->create($input);

        return redirect()->route('forms.edit', $form->id)->withSuccess(trans('admin.forms.message.create_success'));
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
        $form = $this->formRepo->find($id);
        $fields = $this->formRepo->getFields($form->id);

        return view('admin.forms.form', compact('form', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\FormUpdateRequest $request, $id)
    {
        $input = $request->all();
        $input['enabled'] = $request->has('enabled');

        $form = $this->formRepo->update($id, $input);

        return back()->withSuccess(trans('admin.forms.message.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->formRepo->delete($id);

        return back()->withSuccess(trans('admin.forms.message.delete_success'));
    }
}
