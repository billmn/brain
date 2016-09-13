<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Services\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;

class MenusController extends Controller
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
    public function index(Theme $theme)
    {
        $menus = $this->menuRepo->all();
        $menuPositions = $theme->getMenuPositions();
        $menuPositionsValues = $theme->getMenuPositionsValues();

        return view('admin.menus.index', compact('menus', 'menuPositions', 'menuPositionsValues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = $this->menuRepo->model();

        return view('admin.menus.form', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MenuCreateRequest $request)
    {
        $input = $request->all();
        $input['enabled'] = $request->has('enabled');

        $menu = $this->menuRepo->create($input);

        return redirect()->route('menus.edit', $menu->id)->withSuccess(trans('admin.menus.message.create_success'));
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
        $menu = $this->menuRepo->find($id);
        $fields = [];

        return view('admin.menus.form', compact('menu', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MenuUpdateRequest $request, $id)
    {
        $input = $request->all();
        $input['enabled'] = $request->has('enabled');

        $form = $this->menuRepo->update($id, $input);

        return back()->withSuccess(trans('admin.menus.message.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menuRepo->delete($id);

        return back()->withSuccess(trans('admin.menus.message.delete_success'));
    }

    /**
     * Set menu position.
     *
     * @return \Illuminate\Http\Response
     */
    public function positions(Request $request, Theme $theme)
    {
        $theme->setMenuPositions($request->except('_token'));

        return back()->withSuccess(trans('admin.menus.message.position_success'));
    }
}
