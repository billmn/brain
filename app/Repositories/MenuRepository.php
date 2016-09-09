<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Entities\MenuElement;

class MenuRepository
{
    protected $model;
    protected $itemModel;

    public function __construct(Menu $model, MenuItem $itemModel)
    {
        $this->model = $model;
        $this->itemModel = $itemModel;
    }

    /**
     * Model instance.
     *
     * @return \App\Models\Menu
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Count Menus.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * All Menus.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    /**
     * Enabled Menus.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function enabled()
    {
        return $this->model->where('enabled', true)->orderBy('name')->get();
    }

    /**
     * Find a Menu by ID.
     *
     * @param  int $id
     * @return \App\Models\Menu
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find a Menu by name.
     *
     * @param  string $name
     * @return \App\Models\Menu
     */
    public function findByName($name)
    {
        return $this->model->where('name', $name)->firstOrFail();
    }

    /**
     * Create a Menu.
     *
     * @param  array  $input
     * @return \App\Models\Menu
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a Menu.
     *
     * @param  int    $id
     * @param  array  $input
     * @return \App\Models\Menu
     */
    public function update($id, array $input)
    {
        $menu = $this->find($id);
        $menu->fill($input);
        $menu->save();

        return $menu;
    }

    /**
     * Delete a Menu.
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $menu = $this->find($id);
        $menu->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | FIELDS
    |--------------------------------------------------------------------------
    */

    /**
     * Item Model instance.
     *
     * @return \App\Models\MenuItem
     */
    public function itemModel()
    {
        return $this->itemModel;
    }

    /**
     * Available Items Types.
     *
     * @return array
     */
    public function getItemTypeList()
    {
        return $this->itemModel->getTypeList();
    }

    /**
     * Get Menu Items.
     *
     * @param  int $menuId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItems($menuId)
    {
        return $this->itemModel->with('page')->where('menu_id', $menuId)->ordered()->get();
    }

    /**
     * Find an Item by ID.
     *
     * @param  int $itemId
     * @return \App\Models\MenuItem
     */
    public function findItem($itemId)
    {
        return $this->itemModel->findOrFail($itemId);
    }

    /**
     * Add an Item.
     *
     * @param  Form   $menu
     * @param  array  $input
     * @return \App\Models\MenuItem
     */
    public function addItem(Menu $menu, array $input)
    {
        $item = $this->itemModel->fill($input);

        return $menu->items()->save($item);
    }

    /**
     * Update an Item.
     *
     * @param  int    $itemId
     * @param  array  $input
     * @return \App\Models\MenuItem
     */
    public function updateItem($itemId, array $input)
    {
        $item = $this->findItem($itemId);
        $item->fill($input);
        $item->save();

        return $item;
    }

    /**
     * Delete an Item.
     *
     * @param  int $itemId
     * @return void
     */
    public function deleteItem($itemId)
    {
        $item = $this->findItem($itemId);
        $item->delete();
    }

    /**
     * Reorder menu Items.
     *
     * @param int    $menuId
     * @param array  $items
     * @return void
     */
    public function setItemsOrder($menuId, array $items)
    {
        $this->itemModel->setNewOrder($items);

        return $this->getFields($menuId);
    }

    public function getEntities($menuId)
    {
        $entities = [];

        foreach ($this->getItems($menuId) as $item) {
            $entities[] = (new MenuElement($item, $item->sublevels))->fill();
        }

        return collect($entities);
    }
}
