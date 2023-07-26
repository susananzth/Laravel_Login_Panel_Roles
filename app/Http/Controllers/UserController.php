<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('user_index')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $users = User::all();
            return view('user.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('user_add')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            return view('user.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if (Gate::denies('user_add')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $validated = $request->validated();

            $user = new User;
            $user->name     = $validated['name'];
            $user->email    = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->save();

            return redirect()->route('user.index')
                ->with('message', trans('message.User registered successfully.'))
                ->with('alert_class', 'success');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Gate::denies('user_index')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $data['user'] = $user;
            return view('user.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::denies('user_edit')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $data['user'] = $user;
            return view('user.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        if (Gate::denies('user_edit')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $validated = $request->validated();

            $user->name  = $validated['name'];
            $user->email = $validated['email'];
            if (isset($validated['password']) && $validated['password'] != '') {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();

            return redirect()->route('user.edit', $user->id)
                ->with('message', trans('message.User updated successfully.'))
                ->with('alert_class', 'success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Gate::denies('user_delete')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {

            $user->delete();

            return redirect()->route('user.index')
                ->with('message', trans('message.Deleted Successfully.', ['name' => __('User')]))
                ->with('alert_class', 'success');
        }
    }
}
