<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a paginated listing of users with their assigned roles.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = User::with('roles')
            ->select(['id', 'name', 'email', 'username','google2fa_secret', 'google2fa_enabled', 'created_at']);

        // Search filter
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm)
                    ->orWhere('username', 'LIKE', $searchTerm);
            });
        }

        $users = $query->orderBy('name')->paginate(10)->appends($request->query());
        $totalUser = User::count();
        $roles = Role::all();

        if ($request->ajax()) {
            return response()->json([
                'html'  => view('form.user.partials.table', compact('users', 'roles'))->render(),
                'total' => $totalUser,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $users,
                'total'   => $totalUser,
            ]);
        }

        return view('form.user.user', compact('users', 'totalUser', 'roles'));
    }

    /**
     * Store a newly created user and assign an initial role.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        // Hash password and create user record in MySQL
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Assign initial role via spatie/laravel-permission
        $user->assignRole($request->role);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data'    => $user->load('roles'),
            ], 201);
        }

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Update or replace a user's assigned role.
     *
     * @param UpdateUserRoleRequest $request
     * @param User $user
     * @return RedirectResponse|JsonResponse
     */
    public function updateRole(UpdateUserRoleRequest $request, User $user)
    {
        // Replace all existing roles with the selected role
        $user->syncRoles([$request->role]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Role for user '{$user->name}' updated to '{$request->role}'.",
                'data'    => $user->load('roles'),
            ]);
        }

        return redirect()->route('user.index')->with('success', "Role for user '{$user->name}' updated to '{$request->role}'.");
    }

    /**
 * Remove the specified user from storage.
 */
public function destroy(Request $request, User $user)
{
    // Prevent deleting the currently logged-in account
    if (Auth::id() === $user->id) {
        $message = 'អ្នកមិនអាចលុប Account ដែលកំពុង Login បានទេ។';

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], 403);
        }

        return redirect()
            ->route('user.index')
            ->with('error', $message);
    }

    $userName = $user->name;

    $user->delete();

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => "User '{$userName}' has been deleted successfully.",
        ]);
    }

    return redirect()
        ->route('user.index')
        ->with('success', "User '{$userName}' has been deleted successfully.");
}

    /**
     * Reset the target user's Two-Factor Authentication enrollment.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function resetTwoFactor($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with(['error' => 'រកមិនឃើញអ្នកប្រើប្រាស់']);
        }

        $user->resetTwoFactorAuthentication();

        return redirect()->back()->with(['success' => 'Two-Factor Authentication របស់ ' . $user->name . ' ត្រូវបានកំណត់ឡើងវិញដោយជោគជ័យ']);
    }
}
