<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Model instance.
     *
     * @return \App\Models\Page
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Count Pages.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Available Page Status.
     *
     * @return array
     */
    public function getStatusList()
    {
        return $this->model->getStatusList();
    }

    /**
     * All pages.
     *
     * @param  array  $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $params = [])
    {
        $onlyVisible = array_get($params, 'onlyVisible', false);
        $query = $this->model->withDepth()->defaultOrder();

        if ($onlyVisible === true) {
            $query = $query->visible();
        }

        return $query->get();
    }

    /**
     * All visible pages.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allVisible()
    {
        return $this->all(['onlyVisible' => true]);
    }

    /**
     * Basic Tree structure of pages (useful for treeview).
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function basicTree()
    {
        $node = function ($item) use (&$node) {
            $keys = [
                'id' => $item->id,
                'name' => $item->title,
            ];

            foreach ($item->children->all() as $children) {
                $keys['children'][] = $node($children);
            }

            return $keys;
        };

        return $this->all()->toTree()->map(function ($item) use ($node) {
            return $node($item);
        });
    }

    /**
     * Find a Page by ID.
     *
     * @param  int $id
     * @param  bool $visible
     * @return \App\Models\Page
     */
    public function find($id, $visible = false)
    {
        $query = $this->model;

        if ($visible) {
            $query = $query->visible();
        }

        return $query->findOrFail($id);
    }

    /**
     * Find a Page by Path.
     *
     * @param  string $path
     * @param  bool $visible
     * @return \App\Models\Page
     */
    public function findByPath($path, $visible = false)
    {
        $query = $this->model;

        if ($visible) {
            $query = $query->visible();
        }

        return $query->where('path', $path)->firstOrFail();
    }

    /**
     * Find a Page by Slug.
     *
     * @param  string $slug
     * @param  bool $visible
     * @return \App\Models\Page
     */
    public function findBySlug($slug, $visible = false)
    {
        $query = $this->model;

        if ($visible) {
            $query = $query->visible();
        }

        return $query->where('slug', $slug)->firstOrFail();
    }

    /**
     * Create a Page.
     *
     * @param  array  $input
     * @return \App\Models\Page
     */
    public function create(array $input)
    {
        $page = $this->model->create($input);

        $page->path = $page->getFullPath();
        $page->save();

        return $page;
    }

    /**
     * Update a Page.
     *
     * @param  int    $id
     * @param  array  $input
     * @return \App\Models\Page
     */
    public function update($id, array $input)
    {
        $page = $this->find($id);
        $page->fill($input);
        $page->save();

        $page->path = $page->getFullPath();
        $page->save();

        $this->updateChildsPath($page);

        return $page;
    }

    /**
     * Delete a Page.
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $page = $this->find($id);
        $page->delete();
    }

    /**
     * Move a page.
     *
     * @param  string $position
     * @param  Page   $moved
     * @param  Page   $target
     * @return \App\Models\Page
     */
    public function move($position, Page $moved, Page $target)
    {
        switch ($position) {
            case 'before':
                $moved->beforeNode($target)->save();
                break;
            case 'after':
                $moved->afterNode($target)->save();
                break;
            case 'inside':
                $moved->appendToNode($target)->save();
                break;
        }

        $moved->path = $moved->getFullPath();
        $moved->save();

        $this->updateChildsPath($moved);

        return $moved;
    }

    /**
     * Update page's childrens path.
     *
     * @param  \App\Models\Page $page
     * @return void
     */
    protected function updateChildsPath($page)
    {
        $page->descendants->each(function ($child) {
            $child->path = $child->getFullPath();
            $child->save();
        });
    }
}
