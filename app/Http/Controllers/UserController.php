<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show all users.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $users = User::orderByDesc('created_at')
            ->simplePaginate(10);

        return view('front.users.index', compact('users'));
    }

    /**
     * Save new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create($request->only([
                'email', 'name', 'password',
            ]) + ['email_verified_at' => now()]);

        Card::create([
            'user_id' => $user->id,
            'type' => Card::TYPE_TYPICAL,
        ]);

        return redirect()->back()
            ->with('success', trans('notifications.store.success'));
    }
}
