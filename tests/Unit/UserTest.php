<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Product;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testGetEmail(): void
    {
        $value = 'test@test.fr';

        $response = $this->user->setEmail($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getEmail());
        self::assertEquals($value, $this->user->getUsername());
    }

    public function testGetRoles(): void
    {
        $value = ['ROLE_ADMIN'];

        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    public function testGetPassword(): void
    {
        $value = 'password';

        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains($value, $this->user->getPassword());
    }

    public function testGetProduct(): void
    {
        $value = new Product();

        $response = $this->user->addProduct($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getProducts());
        self::assertTrue($this->user->getProducts()->contains($value));

        $response = $this->user->removeProduct($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(0, $this->user->getProducts());
        self::assertFalse($this->user->getProducts()->contains($value));
    }

    public function testGetProducts(): void
    {
        $value = new Product();
        $value1 = new Product();
        $value2 = new Product();

        $this->user->addProduct($value);
        $this->user->addProduct($value1);
        $this->user->addProduct($value2);

        self::assertCount(3, $this->user->getProducts());
        self::assertTrue($this->user->getProducts()->contains($value));
        self::assertTrue($this->user->getProducts()->contains($value1));
        self::assertTrue($this->user->getProducts()->contains($value2));

        $response = $this->user->removeProduct($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(2, $this->user->getProducts());
        self::assertFalse($this->user->getProducts()->contains($value));
        self::assertTrue($this->user->getProducts()->contains($value1));
        self::assertTrue($this->user->getProducts()->contains($value2));
    }
}
