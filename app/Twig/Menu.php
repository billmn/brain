<?php

namespace App\Twig;

use Twig_Extension;
use Twig_SimpleFilter;
use App\Services\Theme;
use Twig_SimpleFunction;
use App\Models\Menu as MenuModel;
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
            new Twig_SimpleFunction('menu_find_by_position', [$this, 'findByPosition']),
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

    public function getItems($menu)
    {
        if (! $menu instanceof MenuModel) {
            return null;
        }

        return $this->menuRepo->getItems($menu->id);
    }

    public function getElements($menu, $sublevels = null)
    {
        if (! $menu instanceof MenuModel) {
            return null;
        }

        return $this->menuRepo->getElements($menu->id, $sublevels);
    }

    public function findByPosition($position)
    {
        $theme = app(Theme::class);
        $values = $theme->getMenuPositionsValues();

        if ($values and isset($values[$position]) and $values[$position] > 0) {
            return $this->find($values[$position]);
        }

        return null;
    }
}
