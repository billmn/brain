<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FormRepository;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    public function register($formId, Request $request, FormRepository $formRepo, MessageRepository $messageRepo)
    {
        $form = $formRepo->find($formId);
        $fields = $form->fields;

        $fieldsRules = $fields->pluck('rules', 'name')->merge([
            'hp'      => 'honeypot',
            'hp_time' => 'required|honeytime:5',
        ]);

        // Fields validation
        $this->validate($request, $fieldsRules->toArray());

        // Message registration
        $messageRepo->create($request->get('email'), $form, $request->except('_token', 'hp', 'hp_time'));

        return back()->with('form_success', $form->success_message);
    }
}
