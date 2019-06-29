<?php


namespace Tests\Unit\Entity\User;


use App\Domain\User\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testCreate()
    {
       $user = User::new(
           $name = 'name',
           $email = 'email',
           $password = 'password'
       );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);
        self::assertNotEmpty($user->password);
        self::assertNotEquals($password, $user->password);

        self::assertTrue($user->isActive());
        self::assertFalse($user->isWait());
        self::assertFalse($user->isAdmin());
    }
}
