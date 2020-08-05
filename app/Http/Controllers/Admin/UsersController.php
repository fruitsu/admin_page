<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserSavingRequest;
use App\Http\Controllers\Controller;
use Exception;
use Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::latest()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSavingRequest $request): RedirectResponse
    {
        $attributes = $request->only('name', 'role', 'email');
        $attributes['password'] = Hash::make($request->input('password'));

        $user = User::create($attributes);

        return redirect(route('admin.users.edit', [$user->id]))
            ->with('success', __('admin.users.messages.created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserSavingRequest $request, User $user): RedirectResponse
    {
        $attributes = $request->only('name', 'role', 'email');

        if ($request->filled('password')) {
            $attributes['password'] = Hash::make($request->input('password'));
        }

        $user->update($attributes);

        return back()->with('success', __('admin.users.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect(route('admin.users.index'))->with('success', __('admin.users.messages.deleted'));
    }
}
