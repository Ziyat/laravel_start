<?php


namespace App\Domain\User\UseCases\Services;

use App\Domain\User\Entities\User;
use App\Domain\User\UseCases\Repositories\UserRepository;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UserService
 * @package App\Domain\User\UseCases\Services
 * @property UserRepository $users
 */
class UserService
{
    private $users;

    public function __construct(UserRepository $repository)
    {
        $this->users = $repository;
    }

    public function create(CreateRequest $request)
    {
        $password = Str::random();
        $user = User::new($request['name'], $request['email'], $password);
        return $user;
    }

    public function register(RegisterRequest $request): User
    {
        $user = User::register($request['name'], $request['email'], $request['password']);
        Mail::to($user->email)->send(new VerifyMail($user));
        event(new Registered($user));
        return $user;
    }

    /**
     * @param $token
     * @throws \DomainException
     * @throws NotFoundHttpException
     */
    public function verify($token)
    {
        $user = $this->users->getByVerifyToken($token);
        $user->verify();
    }
}