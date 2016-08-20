<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;

class MenusItemsController extends Controller
{
    protected $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        parent::__construct();

        $this->menuRepo = $menuRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menuId)
    {
        $nodes = [];

        foreach ($this->menuRepo->getItems($menuId) as $item) {
            $nodes[] = [
                'id' => $item->id,
                'name' => $item->label,
            ];
        }

        return $nodes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menuId)
    {
        $menu = $this->menuRepo->find($menuId);
        $item = $this->menuRepo->itemModel();
        $typeList = $this->menuRepo->getItemTypeList();

        return view('admin.menus.items.form', compact('menu', 'item', 'typeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($menuId, Requests\MenuItemCreateRequest $request)
    {
        $menu = $this->menuRepo->find($menuId);
        $item = $this->menuRepo->addItem($menu, $request->all());

        return redirect()->route('menus.items.edit', [$menu, $item])->withSuccess(trans('admin.menus_items.message.create_success'));
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
    public function edit($menuId, $itemId)
    {
        $menu = $this->menuRepo->find($menuId);
        $item = $this->menuRepo->findItem($itemId);
        $typeList = $this->menuRepo->getItemTypeList();

        return view('admin.menus.items.form', compact('menu', 'item', 'typeList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MenuItemUpdateRequest $request, $menuId, $itemId)
    {
        $item = $this->menuRepo->updateItem($itemId, $request->all());

        return back()->withSuccess(trans('admin.menus_items.message.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($menuId, $itemId)
    {
        $this->menuRepo->deleteItem($itemId);

        return $itemId;
    }

    /**
     * Move the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function move(Request $request)
    {
        $menuId = $request->get('form');
        $nodeList = json_decode($request->get('nodes'), true);

        return $this->menuRepo->setItemsOrder($menuId, $nodeList);
    }
}
