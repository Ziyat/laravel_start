<?php


namespace Tests\Unit\Entity\User;


use App\Domain\User\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testChange()
    {
        $user = \factory(User::class)->create(['role' => User::ROLE_USER]);

        self::assertFalse($user->isAdmin());

        $user->changeRole(User::ROLE_ADMIN);

        self::assertTrue($user->isAdmin());
    }

    public function testAlready()
    {
        $user = \factory(User::class)->create(['role' => User::ROLE_ADMIN]);
        $this->expectExceptionMessage('Role is already assigned.');
        $user->changeRole(User::ROLE_ADMIN);
    }
}
