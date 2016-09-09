<?php

namespace App\Http\Controllers;

use App\Services\Website;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use App\Repositories\PageRepository;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PagesController extends Controller
{
    protected $theme;
    protected $pageRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepository $pageRepo, Website $website)
    {
        parent::__construct();

        $this->theme = app('themes');
        $this->pageRepo = $pageRepo;

        $this->theme->setActive(settings('theme'));

        if ($website->isOffline()) {
            abort(503);
        }
    }

    /**
     * Show the website home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->theme->view('home');
    }

    /**
     * Show the requested website page.
     *
     * @return \Illuminate\Http\Response
     */
    public function page($path)
    {
        try {
            if ($page = $this->pageRepo->findByPath($path, true) and $page->hasVisibleParents()) {
                $view = 'page';

                if ($page->template and $this->theme->viewExists($page->template)) {
                    $view = $page->template;
                }

                return $this->theme->view($view, compact('page'));
            }
        } catch (ModelNotFoundException $e) {
            // Do nothing
        }

        abort(404);
    }

    /**
     * Show the requested image.
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function image($path, Request $request)
    {
        $server = ServerFactory::create([
            'cache' => storage_path('glide'),
            'source' => public_path('files'),
            'response' => app()->make(LaravelResponseFactory::class),
        ]);

        return $server->getImageResponse($path, $request->query());
    }
}
