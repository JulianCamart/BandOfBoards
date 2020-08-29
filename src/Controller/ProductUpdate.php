<?php

namespace App\Controller;

use App\Entity\Product;

class ProductUpdate
{
    public function __invoke(Product $data): Product
    {
        $data->setUpdatedAt(new \DateTimeImmutable('now'));

        return $data;
    }
}
