<?php

namespace App\Cart;

use App\Entity\Product;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CartHandler
{
    public function __construct(
        #[Autowire(service: SessionCart::class)]
        private CartInterface $cart,
    ) {}

    public function addToCart(Product $product, int $quantity = 1): void
    {
        $this->cart->add($product, $quantity);
    }

    public function removeFromCart(int $productId): void
    {
        $this->cart->remove($productId);
    }

    public function getCartItems(): array
    {
        return $this->cart->getItems();
    }

    public function getCartTotal(): float
    {
        return $this->cart->getTotal();
    }

    public function clearCart(): void
    {
        $this->cart->clear();
    }
}