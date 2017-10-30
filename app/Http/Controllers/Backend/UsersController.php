<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UsersValidator;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Backend
 */
class UsersController extends Controller
{
    private $userRepository; /** @var UserRepository $uerRepository */
    /**
     * UsersController constructor.
     *
     * @todo: Set up permissions for the controller.
     *
     * @param  UserRepository $userRepository Abstraction layer between database and user.
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
    }

    /**
     * Get the index control panel for the users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.users.index', [
            'users' => $this->userRepository->paginate(25)
        ]);
    }

    /**
     * Get the view for creating a new user in the system.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.users.create');
    }

    /**
     * Store a new user in the system.
     * ----
     * NOTE: perms handled in the validator instance.
     *
     * @param  UsersValidator $input The user input validation instance.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersValidator $input): RedirectResponse
    {
        $password = str_random(60);
        $filter   = ['firstName', 'lastName'];

        $input->merge(['name' => "{$input->firstName} {$input->lastName}", 'password' => $password]);

        if ($user = $this->userRepository->create($input->except($filter))) {
            activity()->causedBy(auth()->user())->log("Added {$user->name} as user.");
            flash("{$user->name} has been added. And his password setup has been mailed.")->success();

            // TODO: Set up queueable mail for the user information.
        }

        return redirect()->route('users.index');
    }
}
