<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Product;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $article;

    protected function setUp()
    {
        parent::setUp();

        $this->product = new Product();
    }

    public function testGetName(): void
    {
        $value = 'Super name de test';

        $response = $this->product->setName($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getName());
    }

    public function testGetModel(): void
    {
        $value = 'Super model de test';

        $response = $this->product->setModel($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getModel());
    }

    public function testGetBrand(): void
    {
        $value = 'Super brand de test';

        $response = $this->product->setBrand($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getBrand());
    }

    public function testGetType(): void
    {
        $value = 'Super type de test';

        $response = $this->product->setType($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getType());
    }

    public function testGetSize(): void
    {
        $value = strval(9.25);

        $response = $this->product->setSize($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getSize());
    }

    public function testGetGripped(): void
    {
        $value = true;

        $response = $this->product->setGripped($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getGripped());
    }

    public function testGetDescription(): void
    {
        $value = 'Super type de test';

        $response = $this->product->setDescription($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getDescription());
    }

    public function testGetPrice(): void
    {
        $value = strval(50.99);

        $response = $this->product->setPrice($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getPrice());
    }

    public function testGetVendor(): void
    {
        $value = new User();

        $response = $this->product->setVendor($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertInstanceOf(User::class, $this->product->getVendor());
    }
}