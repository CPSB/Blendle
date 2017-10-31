<?php

namespace App\Http\Controllers\Backend;

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
    /**
     * AccountSettingsController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Get the view for the account settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.account-settings-index');
    }

    /**
     * @param  AccountInfo $input The validator instance forthe input.
     * @return RedirectResponse
     */
    public function updateSettings(AccountInfo $input): RedirectResponse
    {
        return redirect()->route('account.settings');
    }

    /**
     * @param  AccountSecurity $input The validator instance for the input.
     * @return RedirectResponse
     */
    public function updateSecurity(AccountSecurity $input): RedirectResponse
    {
        return redirect()->route('account.settings');
    }
}
