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
}
