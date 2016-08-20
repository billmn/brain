<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Model instance.
     *
     * @return \App\Models\User
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Count Users.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * All Users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    /**
     * Find a User.
     *
     * @param  int $id
     * @return \App\Models\User
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a User.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $input['password'] = bcrypt($input['password']);

        return $this->model->create($input);
    }

    /**
     * Update a User.
     *
     * @param  int    $id
     * @param  array  $input
     * @return \App\Models\User
     */
    public function update($id, array $input)
    {
        $user = $this->find($id);

        if (isset($input['password']) and ! empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            array_forget($input, 'password');
        }

        $user->fill($input);
        $user->save();

        return $user;
    }

    /**
     * Delete a User.
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
    }
}
