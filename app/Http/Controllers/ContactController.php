<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FormRepository;

class ContactController extends Controller
{
    public function register($formId, Request $request, FormRepository $formRepo)
    {
        $form = $formRepo->find($formId);
        $fields = $form->fields;
        $fieldsRules = $fields->pluck('rules', 'name')->merge([
            'hp'      => 'honeypot',
            'hp_time' => 'required|honeytime:5',
        ]);

        // Fields validation
        $this->validate($request, $fieldsRules->toArray());

        // Fields / Input
        $fields->each(function ($field) use ($request) {
            $field->input = $request->get($field->name);
        });

        dd($fields->toArray());
    }
}
