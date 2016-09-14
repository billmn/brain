<?php

namespace App\Twig;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use App\Services\Theme as ThemeService;

class Common extends Twig_Extension
{
    protected $theme;

    public function __construct(ThemeService $theme)
    {
        $this->theme = $theme;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Brain_Common_Extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('label', [$this, 'label']),
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

    public function label($name, $default = null)
    {
        if (str_contains($name, '::')) {
            list($theme, $key) = explode('::', $name);
            return settings("{$theme}::labels.{$key}", $default);
        }

        return settings("labels.{$name}", $default);
    }
}
