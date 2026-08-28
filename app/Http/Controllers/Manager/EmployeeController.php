<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EmployeeController extends Controller
{
    private function authorizeAccess(): void
    {
        abort_if(! auth()->user()->canManageEmployees(), 403,
            'Only Super Admins and HR Managers can manage employees.');
    }

    public function index()
    {
        $this->authorizeAccess();

        // Only list operational managers/staff — super admin is separate in Filament /monarch
        $employees = User::whereIn('role', ['content_manager', 'store_manager', 'hr_manager'])
            ->where('is_super_admin', false)
            ->orderBy('role')
            ->orderBy('name')
            ->paginate(20);

        return view('manager.employees.index', compact('employees'));
    }

    public function create()
    {
        $this->authorizeAccess();

        $roles = [
            'content_manager' => 'Content Manager',
            'store_manager'   => 'Store Manager',
            'hr_manager'      => 'HR Manager',
        ];

        return view('manager.employees.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorizeAccess();

        $allowedRoles = ['content_manager', 'store_manager', 'hr_manager'];

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:' . implode(',', $allowedRoles),
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $employee = User::create([
            'name'             => $data['name'],
            'email'            => $data['email'],
            'role'             => $data['role'],
            'password'         => Hash::make($data['password']),
            'is_super_admin'   => false,
            'email_verified_at'=> now(),
        ]);

        return redirect()->route('manager.employees')
            ->with('success', "Manager account for {$employee->name} created successfully.");
    }

    public function edit(User $user)
    {
        $this->authorizeAccess();

        // Super admins cannot be edited from the manager portal
        abort_if($user->isSuperAdmin(), 403, 'Super Admin accounts can only be managed via the Filament admin panel.');
        abort_if($user->id === auth()->id(), 403, 'Edit your account through Profile settings.');

        $roles = [
            'content_manager' => 'Content Manager',
            'store_manager'   => 'Store Manager',
            'hr_manager'      => 'HR Manager',
        ];

        return view('manager.employees.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeAccess();

        abort_if($user->isSuperAdmin(), 403, 'Super Admin accounts can only be managed via the Filament admin panel.');
        abort_if($user->id === auth()->id(), 403, 'Edit your account through Profile settings.');

        $allowedRoles = ['content_manager', 'store_manager', 'hr_manager'];

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'role'     => 'required|in:' . implode(',', $allowedRoles),
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $updateData = [
            'name' => $data['name'],
            'role' => $data['role'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return redirect()->route('manager.employees')
            ->with('success', "Manager account for {$user->name} updated successfully.");
    }

    public function destroy(User $user)
    {
        $this->authorizeAccess();

        abort_if($user->isSuperAdmin(), 403, 'Super Admin accounts cannot be removed from here.');
        abort_if($user->id === auth()->id(), 403);

        $user->delete();
        return redirect()->route('manager.employees')
            ->with('success', 'Manager account removed.');
    }
}
