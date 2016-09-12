<?php

namespace App\Twig;

use Twig_Extension;
use App\Models\Menu;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use App\Repositories\MenuRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Menu extends Twig_Extension
{
    protected $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Brain_Menu_Extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('menu_find', [$this, 'find']),
            new Twig_SimpleFunction('menu_items', [$this, 'getItems']),
            new Twig_SimpleFunction('menu_elements', [$this, 'getElements']),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            // new Twig_SimpleFilter('camel_case', [$this->callback, 'camel']),
        ];
    }

    public function find($id)
    {
        try {
            return is_numeric($id) ? $this->menuRepo->find($id) : $this->menuRepo->findByName($id);
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function getItems(Menu $menu)
    {
        return $this->menuRepo->getItems($menu->id);
    }

    public function getElements(Menu $menu, $sublevels = null)
    {
        return $this->menuRepo->getElements($menu->id, $sublevels);
    }
}
