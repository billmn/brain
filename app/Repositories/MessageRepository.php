<?php

namespace App\Repositories;

use Notification;
use App\Models\Form;
use App\Models\Message;
use App\Models\FormField;
use App\Notifications\MessageRegistered;

class MessageRepository
{
    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    /**
     * Model instance.
     *
     * @return \App\Models\Message
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Count Messages.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * All Messages.
     *
     * @param  array  $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $params = [])
    {
        $paginate = array_get($params, 'paginate', false);
        $query = $this->model->latest();

        return is_numeric($paginate) ? $query->paginate($paginate) : $query->get();
    }

    /**
     * Find a Message.
     *
     * @param  int $id
     * @return \App\Models\Message
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a Message.
     *
     * @param  array  $input
     * @return \App\Models\Message
     */
    public function create($email, Form $form, array $input)
    {
        $fields = $form->fields->each(function ($field) use ($input) {
            $field->input = array_get($input, $field->name);
        });

        $data = [
            'email'     => $email,
            'fields'    => $fields,
            'form_id'   => $form->id,
            'form_name' => $form->name,
        ];

        $message = $this->model->create($data);

        Notification::send($message, new MessageRegistered($form, $message));

        return $message;
    }

    /**
     * Update a Message.
     *
     * @param  int    $id
     * @param  array  $input
     * @return \App\Models\Message
     */
    public function update($id, array $input)
    {
        $message = $this->find($id);
        $message->fill($input);
        $message->save();

        return $message;
    }

    /**
     * Delete a Message.
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $message = $this->find($id);
        $message->delete();
    }
}
