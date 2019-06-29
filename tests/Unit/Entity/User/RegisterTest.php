<?php


namespace Tests\Unit\Entity\User;


use App\Domain\User\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testRequest()
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);
        self::assertNotEmpty($user->password);
        self::assertNotEquals($password, $user->password);
    }

    /**
     * @throws \DomainException
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testVerify()
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password'
        );
        $user->verify();

        self::assertTrue($user->isActive());
        self::assertFalse($user->isWait());
        self::assertFalse($user->isAdmin());
    }
}
