<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show(User $user)
    {
        return redirect()->route('admin.users.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => (bool) $request->is_admin,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Потребителят е създаден.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => (bool) $request->is_admin,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Потребителят е актуализиран.');
    }

    public function destroy(User $user)
    {

        if ($user->id === auth()->id()) {
            return redirect()->back()->withErrors('Не можете да изтриете собствения си акаунт.');
        }
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Потребителят е преместен в кошчето.');
    }

    public function trash()
    {
        $trashedUsers = User::onlyTrashed()->get();
        return view('admin.users.trash', compact('trashedUsers'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.trash')
            ->with('success', 'Потребителят е възстановен.');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admin.users.trash')
            ->with('success', 'Потребителят е изтрит окончателно.');
    }
}