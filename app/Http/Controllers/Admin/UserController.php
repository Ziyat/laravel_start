<?php

namespace App\Http\Controllers\Admin;

use App\Domain\User\Entities\User;
use App\Domain\User\UseCases\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Http\Request;


/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 * @property UserService $service;
 */
class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \InvalidArgumentException
     */
    public function index(Request $request)
    {
        $query = User::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', "%$value%");
        }
        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', "%$value%");
        }
        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }
        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        $users = $query->paginate(5);

        $statuses = User::getStatuses();
        $roles = User::getRoles();
        return view('admin.user.index', compact('users', 'statuses', 'roles'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $user = $this->service->create($request);
            return redirect()->route('admin.user.show', $user);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        try {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email']
            ]);
            return redirect()->route('admin.user.show', $user);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \DomainException
     */
    public function verify(User $user)
    {
        $user->verify();
        return redirect()->route('admin.user.show', $user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Delete user success');
    }
}
