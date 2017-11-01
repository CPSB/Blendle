<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\RoleRepository;
use Gate;
use App\Http\Requests\Backend\UsersValidator;
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
        $this->middleware(['auth', 'role:admin'])->except(['destroy']);
        $this->middleware('forbid-banned-user');

        $this->userRepository = $userRepository;
    }

    /**
     * Get the index control panel for the users.
     *
     * @param  string $role The role group for the users.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($role = null): View
    {
        // Check if the user has given system roles.
        in_array($role, ['user', 'admin']) ?: abort(Response::HTTP_NOT_FOUND);

        $users =  $this->userRepository->entity()->whereHas('roles', function ($query) use ($role) {
            $query->where(config('permission.table_names.roles') . '.name', $role);
        });

        return view('backend.users.index', ['users' => $users->paginate(20), 'role' => $role]);
    }

    /**
     * Get the view for creating a new user in the system.
     *
     * @param  RoleRepository $roleRepository Abstraction layer between controller and role db table.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(RoleRepository $roleRepository): View
    {
        return view('backend.users.create', ['roles' => $roleRepository->all(['name'])]);
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

        if ($user = $this->userRepository->create($input->all())->assignRole($input->role)) {
            activity()->causedBy(auth()->user())->log("Added {$user->name} as user.");
            flash("{$user->name} has been added. And his password setup has been mailed.")->success();

            // TODO: Set up queueable mail for the user information.
            // TODO: Set up implementation to detach roles by user creation.
        }

        return redirect()->route('users.index', ['role' => $input->role]);
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

                if ($authUser->id != $user->id && $authUser->hasRole('admin')) {
                    activity()->causedBy($authUser)->log("The user {$user->name} has been deleted.");
                    // TODO: Queueable mail to let the user known that he has been deleted.
                }
            }
        }

        return redirect()->route('users.index', ['role' => ($user->hasRole('admin') == true) ? 'admin' : 'user']);
    }
}
