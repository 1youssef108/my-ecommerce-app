<?php

namespace App\Cart;

use App\Entity\Product;

interface CartInterface
{
    public function add(Product $product, int $quantity): void;
    public function remove(int $productId): void;
    public function getItems(): array;
    public function getTotal(): float;
    public function clear(): void;
}