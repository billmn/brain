<?php

namespace App\Twig;

use Twig_Extension;
use Twig_SimpleFilter;
use App\Services\Theme;
use Twig_SimpleFunction;

class Theme extends Twig_Extension
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Brain_Theme_Extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('theme_asset', [$this, 'asset']),
            new Twig_SimpleFunction('theme_label', [$this, 'label']),
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

    public function asset($path)
    {
        return $this->theme->asset($path);
    }

    public function label($name, $default = null)
    {
        return $this->theme->label($name, $default);
    }
}
