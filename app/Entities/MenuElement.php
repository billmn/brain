<?php

namespace App\Entities;

use App\Models\Page;
use App\Models\MenuItem;
use Illuminate\Support\Collection;

class MenuElement extends Collection
{
    protected $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function fill()
    {
        if ($this->item instanceof Page) {
            $childrens = $this->item->descendants()->defaultOrder()->get()->toTree();
            $childrens = $this->applyEntity($childrens);

            $this->type = 'page';
            $this->url = $this->item->url;
            $this->slug = $this->item->slug;
            $this->label = $this->item->title;
            $this->childrens = $childrens;
            $this->root = is_null($this->item->parent_id);

        } else {
            $this->type = 'link';
            $this->url = url($this->item->value);
            $this->slug = $this->item->value;
            $this->label = $this->item->label;
            $this->childrens = false;
            $this->root = true;
        }

        return $this;
    }

    protected function applyEntity($items)
    {
        foreach ($items as $index => $item) {
            $items[$index] = (new static($item))->fill();
        }

        return $items;
    }
}
