<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\UserRepository;
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
    public function create()
    {
        return view('backend.users.create');
    }
}
