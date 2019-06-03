<?php


namespace App\Domain\User\UseCases\Repositories;


use App\Domain\User\Entities\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository
{
    /**
     * @param int $id
     * @return User
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @param string $token
     * @return User
     * @throws NotFoundHttpException
     */
    public function getByVerifyToken(string $token): User
    {
        if(!$user = User::where('verify_token', $token)->first()){
            throw new NotFoundHttpException('User not found.');
        }
        return $user;
    }

    /**
     * @param User $user
     * @throws \DomainException
     */
    public function save(User $user): void
    {
        if(!$user->save()){
            throw new \DomainException('User save error');
        }
    }
}