<?php

namespace App\Cart;

use App\Entity\Product;

class ApiCart implements CartInterface
{
    public function add(Product $product, int $quantity): void
    {
        dd('ApiCart::add()', $product->getName(), $quantity);
    }

    public function remove(int $productId): void
    {
        dd('ApiCart::remove()', $productId);
    }

    public function getItems(): array
    {
        dd('ApiCart::getItems()');
    }

    public function getTotal(): float
    {
        dd('ApiCart::getTotal()');
    }

    public function clear(): void
    {
        dd('ApiCart::clear()');
    }
}