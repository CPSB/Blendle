<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\UserRepository;
use App\Http\Requests\Backend\{AccountInfo, AccountSecurity};
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class AccountSettingsController
 *
 * @package App\Http\Controllers\Backend
 */
class AccountSettingsController extends Controller
{
    // TODO: Register routes
    // TODO: Translate controller flash messages.

    private $userRepository; /** @var UserRepository $userRepository */

    /**
     * AccountSettingsController constructor.
     *
     * @param  UserRepository $userRepository The abstraction layer between database and controlle.
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->userRepository = $userRepository;
    }

    /**
     * Get the view for the account settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.account.index');
    }

    /**
     * @param  AccountInfo $input The validator instance forthe input.
     * @return RedirectResponse
     */
    public function updateSettings(AccountInfo $input): RedirectResponse
    {
        if ($user = $this->userRepository->update($input->except('_token'), auth()->user()->id)) {
            flash("Your account informaation has been updated.")->info();
        }
        return redirect()->route('account.settings');
    }

    /**
     * @param  AccountSecurity $input The validator instance for the input.
     * @return RedirectResponse
     */
    public function updateSecurity(AccountSecurity $input): RedirectResponse
    {
        $input = ['password' => bcrypt($input->password)];

        if ($user = $this->userRepository->update($input, auth()->user()->id)) {
            flash("Your account security has been updated.")->info();
        }
        return redirect()->route('account.settings');
    }
}
