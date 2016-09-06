<?php

namespace App\Entities;

use App\Models\Page;
use App\Models\MenuItem;
use Illuminate\Support\Collection;

class MenuElement extends Collection
{
    protected $item;
    protected static $sublevels;

    public function __construct($item, $sublevels = null)
    {
        $this->item = $item;
        static::$sublevels = $sublevels;
    }

    public function fill()
    {
        $this->type = $this->item->type;

        if ($this->item->type === 'page' or $this->item instanceof Page) {
            $page = $this->item instanceof Page ? $this->item : $this->item->page;

            if (is_null(static::$sublevels) or (static::$sublevels > 0 and ($page->depth + 1) <= static::$sublevels)) {
                $childrens = $page->descendants()->withDepth()->defaultOrder()->get()->toTree();
                $childrens = $this->applyEntity($childrens);
            } else {
                $childrens = false;
            }

            $this->url = $page->url;
            $this->slug = $page->slug;
            $this->label = $page->title;
            $this->childrens = $childrens;
            $this->depth = $page->depth;
            $this->root = is_null($page->parent_id);

        } else {
            $this->url = url($this->item->value);
            $this->slug = $this->item->value;
            $this->label = $this->item->label;
            $this->childrens = false;
            $this->depth = 0;
            $this->root = true;
        }

        return $this;
    }

    protected function applyEntity($items)
    {
        foreach ($items as $index => $item) {
            $items[$index] = (new static($item, static::$sublevels))->fill();
        }

        return $items;
    }
}
