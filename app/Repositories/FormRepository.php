<?php

namespace App\Repositories;

use App\Models\Form;
use App\Models\FormField;

class FormRepository
{
    protected $model;
    protected $fieldModel;

    public function __construct(Form $model, FormField $fieldModel)
    {
        $this->model = $model;
        $this->fieldModel = $fieldModel;
    }

    /**
     * Model instance.
     *
     * @return \App\Models\Form
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Count Forms.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Available Form Types.
     *
     * @return array
     */
    public function getTypeList()
    {
        return $this->model->getTypeList();
    }

    /**
     * All Forms.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    /**
     * Enabled Forms.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function enabled()
    {
        return $this->model->where('enabled', true)->orderBy('name')->get();
    }

    /**
     * Find a Form by ID.
     *
     * @param  int $id
     * @return \App\Models\Form
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a Form.
     *
     * @param  array  $input
     * @return \App\Models\Form
     */
    public function create(array $input)
    {
        $form = $this->model->create($input);

        // Default Email field
        $this->addField($form, [
            'type'  => 'email',
            'name'  => 'email',
            'label' => 'Email',
            'rules' => 'required|email'
        ]);

        return $form;
    }

    /**
     * Update a Form.
     *
     * @param  int    $id
     * @param  array  $input
     * @return \App\Models\Form
     */
    public function update($id, array $input)
    {
        $form = $this->find($id);
        $form->fill($input);
        $form->save();

        return $form;
    }

    /**
     * Delete a Form.
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $form = $this->find($id);
        $form->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | FIELDS
    |--------------------------------------------------------------------------
    */

    /**
     * Field Model instance.
     *
     * @return \App\Models\FormField
     */
    public function fieldModel()
    {
        return $this->fieldModel;
    }

    /**
     * Available Field Types.
     *
     * @return array
     */
    public function getFieldTypeList()
    {
        return $this->fieldModel->getTypeList();
    }

    /**
     * Get Form Fields.
     * @param  int $formId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFields($formId)
    {
        return $this->fieldModel->where('form_id', $formId)->ordered()->get();
    }

    /**
     * Find a FIeld by ID.
     *
     * @param  int $fieldId
     * @return \App\Models\FormField
     */
    public function findField($fieldId)
    {
        return $this->fieldModel->findOrFail($fieldId);
    }

    /**
     * Add a Field.
     *
     * @param  Form   $form
     * @param  array  $input
     * @return \App\Models\FormField
     */
    public function addField(Form $form, array $input)
    {
        $field = $this->fieldModel->fill($input);

        return $form->fields()->save($field);
    }

    /**
     * Update a Field.
     *
     * @param  int    $fieldId
     * @param  array  $input
     * @return \App\Models\FormField
     */
    public function updateField($fieldId, array $input)
    {
        $field = $this->findField($fieldId);
        $field->fill($input);
        $field->save();

        return $field;
    }

    /**
     * Delete a Field.
     *
     * @param  int $fieldId
     * @return void
     */
    public function deleteField($fieldId)
    {
        $field = $this->findField($fieldId);
        $field->delete();
    }

    /**
     * Reorder form Fields.
     *
     * @param int    $formId
     * @param array  $fields
     * @return void
     */
    public function setFieldsOrder($formId, array $fields)
    {
        $this->fieldModel->setNewOrder($fields);

        return $this->getFields($formId);
    }
}
