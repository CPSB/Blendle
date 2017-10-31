<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\{ActivityRepository, UserRepository};

/**
 * Class LogController
 *
 * @package App\Http\Controllers\Backend
 */
class LogController extends Controller
{
    private $activityRepository; /** @var ActivityRepository $activityRepository */

    /**
     * LogController constructor.
     *
     * @param  ActivityRepository $activityRepository The abstraction layer between database and controller.
     * @return void
     */
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->middleware(['role:admin', 'forbid-banned-user']);
        $this->activityRepository = $activityRepository;
    }

    /**
     * Log viewer dat lists the logs from the application handelings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.logs.index', [
            'logs' => $this->activityRepository->paginate(25)
        ]);
    }

    /**
     * Show the activity log from an given user
     *
     * @param  UserRepository  $userRepository  The abstraction layer for the user database model.
     * @param  integer         $userId          The unique identifier from the user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(UserRepository $userRepository, $userId): View
    {
        $user = $userRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);
        $logs = $this->activityRepository->entity()->CausedBy($user)->paginate(25);

        return view('backend.logs.show', compact('user', 'logs'));
    }
}
