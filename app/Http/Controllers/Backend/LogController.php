<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

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
}
