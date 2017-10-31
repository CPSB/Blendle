<?php

namespace App\Http\Controllers\Backend;

use Gate;
use App\Http\Requests\BanValidator;
use App\Mail\{UnblockActionPerformed, BlockActionPerformed};
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class BlockUserController
 *
 * @package App\Http\Controllers
 */
class BlockUserController extends Controller
{
    private $usersRepository; /** @var UserRepository $usersRepository */

    /**
     * BlockUserController constructor.
     *
     * @todo: register unban user
     *
     * @param  UserRepository $userRepository The abstraction layer between database and controller.
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['forbid-banned-user', 'role:admin']);
        $this->usersRepository = $userRepository;
    }

    /**
     * Create view for ban.
     *
     * @param  integer $userId The unique identifier from the user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($userId): View
    {
        $user = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);
        return view('backend.ban.create', compact('user'));
    }

    /**
     * Store the ban in the system.
     * ----
     * NOTE: Permissions are also handled in the validator and GATE policy.
     *
     * @param  BanValidator $input      The validation instance for the given user input.
     * @param  integer      $userId     The unique identifier from the user.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BanValidator $input, $userId): RedirectResponse
    {
        $user = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);

        if (Gate::allows('block', $user)) {     // Check if the user is allowed to perform the action.
            if ($user->isNotBanned()) {         // The given user is not currently banned.
                if ($user->ban(['comment' => $input->reason, 'expired_at' => $input->endDate])) { // DB = USER BANNED
                    $message = "{$user->name} has been blocked in the system.";
                    activity()->causedBy(auth()->user())->log("Has blocked {$user->name} in the system");

                    Mail::to($user->email)->queue(new BlockActionPerformed($input->all()));
                }
            } else { // The user is already banned in the database.
                $message = "{$user->name} has already been blocked in the system.";
            }
        }

        flash(isset($message) ? $message : 'You are not permitted to perform this action.')->info();
        return redirect()->route('users.index');
    }

    /**
     * Delete a user ban in the system.
     * ----
     * NOTE: Permissions are also handled in the GATE policy
     *
     * @param  integer $userId  The unique identifier from the user.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userId): RedirectResponse
    {
        $user = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);

        if (Gate::allows('unblock', $user)) {   // Check if the user is allowed to perform the action.
            if ($user->isBanned()) {            // The given user is banned in the database.
                if ($user->unban()) {           // The user is unbanned in the database.
                    $message = "{$user->name} has been unblocked in the system.";
                    activity()->causedBy(auth()->user())->log("Has unblocked {$user->name} in the system.");

                    Mail::to($user->email)->queue(new UnblockActionperformed());
                }
            } else { // The user has already been unblocked in the system.
                $message = "{$user->name} has already been ublocked in the system.";
            }
        }

        flash(isset($message) ? $message : "You are not permitted to perform this action.")->info();
        return redirect()->route('users.index');
    }
}
