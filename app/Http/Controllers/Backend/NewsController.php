<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NewsValidator;
use App\Repositories\NewsItemRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class NewsController
 *
 * @package App\Http\Controllers
 */
class NewsController extends Controller
{
    private $newsItemRepository; /** @var NewsItemRepository */

    /**
     * NewsController constructor.
     *
     * @param  NewsItemRepository $newsItemRepository Abstraction layer between controller and database.
     * @return void
     */
    public function __construct(NewsItemRepository $newsItemRepository)
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
        $this->newsItemRepository = $newsItemRepository;
    }

    /**
     * Get the index control panel for news messages.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.news.index', [
            'messages' => $this->newsItemRepository->paginate(20),
        ]);
    }

    /**
     * Get the create panel for the news messages.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.news.create');
    }

    /**
     * Store an news message in the system.
     * ----
     * NOTE: Roles also registered in the validation class.
     *
     * @param  NewsValidator $input The given user input validation instance.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsValidator $input): RedirectResponse
    {
        // TODO: Implement avatar
        $input->merge(['publishDate' => (new Carbon($input->publishDate))->format('Y-m-d H:i:s')]);

        if ($message = $this->newsItemRepository->create($input->all())) {
            flash('Your news message has been stored.')->success();
            activity()->causedBy(auth()->user())->log("Has created the news message: '{$message->name}'");
        }

        return redirect()->route('news.index');
    }

    /**
     * Display a specific news resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(): View
    {
        return view('backend.news.index');
    }
}
