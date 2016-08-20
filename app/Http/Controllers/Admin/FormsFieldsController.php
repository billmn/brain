<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FormRepository;

class FormsFieldsController extends Controller
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
    public function index($formId)
    {
        $nodes = [];

        foreach ($this->formRepo->getFields($formId) as $field) {
            $nodes[] = [
                'id' => $field->id,
                'name' => $field->label,
            ];
        }

        return $nodes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($formId)
    {
        $form = $this->formRepo->find($formId);
        $field = $this->formRepo->fieldModel();
        $typeList = $this->formRepo->getFieldTypeList();

        return view('admin.forms.fields.form', compact('form', 'field', 'typeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($formId, Requests\FormFieldCreateRequest $request)
    {
        $input = $request->all();
        $fieldName = trim($request->get('name'));

        if (strlen($fieldName) < 1) {
            $input['name'] = $request->get('label');
        }

        $form = $this->formRepo->find($formId);
        $field = $this->formRepo->addField($form, $input);

        return redirect()->route('forms.fields.edit', [$form, $field])->withSuccess(trans('admin.forms_fields.message.create_success'));
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
    public function edit($formId, $fieldId)
    {
        $form = $this->formRepo->find($formId);
        $field = $this->formRepo->findField($fieldId);
        $typeList = $this->formRepo->getFieldTypeList();

        return view('admin.forms.fields.form', compact('form', 'field', 'typeList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\FormFieldUpdateRequest $request, $formId, $fieldId)
    {
        $input = $request->all();
        $fieldName = trim($request->get('name'));

        if (strlen($fieldName) < 1) {
            $input['name'] = $request->get('label');
        }

        $field = $this->formRepo->updateField($fieldId, $input);

        return back()->withSuccess(trans('admin.forms_fields.message.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($formId, $fieldId)
    {
        $this->formRepo->deleteField($fieldId);

        return $fieldId;
    }

    /**
     * Move the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function move(Request $request)
    {
        $formId = $request->get('form');
        $nodeList = json_decode($request->get('nodes'), true);

        return $this->formRepo->setFieldsOrder($formId, $nodeList);
    }
}
