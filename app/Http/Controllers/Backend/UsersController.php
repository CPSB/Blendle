<?php

namespace App\Http\Controllers\Backend;

use Gate;
use App\Http\Requests\UsersValidator;
use App\Repositories\UserRepository;
use Illuminate\Http\{RedirectResponse, Response};
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
     * @param  UserRepository $userRepository Abstraction layer between database and user.
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('forbid-banned-user');
        $this->middleware('role:admin')->except(['destroy']);

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
            'users' => $this->userRepository->paginate(2)
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
        $input->merge(['name' => "{$input->firstName} {$input->lastName}", 'password' => $password]);

        if ($user = $this->userRepository->create($input->all())) {
            activity()->causedBy(auth()->user())->log("Added {$user->name} as user.");
            flash("{$user->name} has been added. And his password setup has been mailed.")->success();

            // TODO: Set up queueable mail for the user information.
        }

        return redirect()->route('users.index');
    }

    /**
     * Delete a user out off the system.
     *
     * @param  integer $userId The unique identifier from the user.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userId): RedirectResponse
    {
        $authUser = auth()->user();
        $user     = $this->userRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);

        if (Gate::allows('delete', $user)) { // Permission check for the user.
            if ($user->delete()) {
                flash("The {$user->name} has been deleted in the system.")->success();

                if ($authUser->hasRole('admin')) {
                    activity()->causedBy($authUser)->log("The user {$user->name} has been deleted.");
                    // TODO: Queueable mail to let the user known that he has been deleted.
                }
            }
        }

        return redirect()->route('users.index');
    }
}
