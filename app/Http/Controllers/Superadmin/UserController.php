<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Superadmin User Management Controller
 * Handles all user CRUD operations under /superadmin/users namespace
 */
class UserController extends Controller
{
    /**
     * Display list of all users
     */
    public function index()
    {
        $users = User::latest()->paginate(15);

        return view('features.superadmin.users.index', compact('users'));
    }

    /**
     * Show form for creating new user
     */
    public function create()
    {
        return view('features.superadmin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:superadmin,admin,member,partner,driver',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display specific user
     */
    public function show(User $user)
    {
        return view('features.superadmin.users.show', compact('user'));
    }

    /**
     * Show form for editing user
     */
    public function edit(User $user)
    {
        return view('features.superadmin.users.edit', compact('user'));
    }

    /**
     * Update user in database
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:superadmin,admin,member,partner,driver',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove user from database
     */
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
