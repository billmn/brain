<?php

namespace App\Services;

use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory as ViewFactory;
use Caffeinated\Themes\Themes as CaffeinatedThemes;

class Theme extends CaffeinatedThemes
{
    /**
     * Constructor method.
     *
     * @param Filesystem  $files
     * @param Repository  $config
     * @param ViewFactory $viewFactory
     */
    public function __construct(Filesystem $files, Repository $config, ViewFactory $viewFactory)
    {
        parent::__construct($files, $config, $viewFactory);

        $this->setActive(settings('theme'));
    }

    /**
     * Get theme templates.
     *
     * @return array
     */
    public function getTemplates()
    {
        return $this->getProperty("{$this->active}::templates", []);
    }

    /**
     * Get label value.
     *
     * @param  string $name
     * @param  mixed  $default
     * @return mixed
     */
    public function label($name, $default = null)
    {
        return settings("{$this->active}::labels.{$name}", $default);
    }

    /**
     * Get theme labels.
     *
     * @return array
     */
    public function getLabels()
    {
        return $this->getProperty("{$this->active}::labels", []);
    }

    /**
     * Get labels values.
     *
     * @return array
     */
    public function getLabelsValues()
    {
        return settings("{$this->active}::labels", []);
    }

    /**
     * Set labels values.
     *
     * @param  array $labels
     * @return array
     */
    public function setLabelsValues(array $labels)
    {
        if (empty(array_filter($labels))) {
            return settings()->delete("{$this->active}::labels");
        }

        return settings(["{$this->active}::labels" => $labels]);
    }

    /**
     * Get theme menu's positions.
     *
     * @return array
     */
    public function getMenuPositions()
    {
        return $this->getProperty("{$this->active}::menus", []);
    }

    /**
     * Get menu's positions values.
     *
     * @return array
     */
    public function getMenuPositionsValues()
    {
        return settings("{$this->active}::menus", []);
    }

    /**
     * Set menu's positions.
     *
     * @param  array $positions
     * @return array
     */
    public function setMenuPositions(array $positions)
    {
        if (empty(array_filter($positions))) {
            return settings()->delete("{$this->active}::menus");
        }

        return settings(["{$this->active}::menus" => $positions]);
    }
}
