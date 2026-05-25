<?php

namespace App\Cart;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private const CART_KEY = 'cart';

    public function __construct(
        private RequestStack $requestStack,
        private ProductRepository $productRepository,
    ) {}

    private function getSession()
    {
        return $this->requestStack->getSession();
    }

    public function add(Product $product, int $quantity): void
    {
        $cart = $this->getSession()->get(self::CART_KEY, []);
        $productId = $product->getId();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'quantity'   => $quantity,
            ];
        }

        $this->getSession()->set(self::CART_KEY, $cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getSession()->get(self::CART_KEY, []);
        unset($cart[$productId]);
        $this->getSession()->set(self::CART_KEY, $cart);
    }

    public function getItems(): array
    {
        $cart = $this->getSession()->get(self::CART_KEY, []);
        $items = [];

        foreach ($cart as $item) {
            $product = $this->productRepository->find($item['product_id']);
            if ($product) {
                $items[] = [
                    'product'  => $product,
                    'quantity' => $item['quantity'],
                    'total'    => $product->getPrice() * $item['quantity'],
                ];
            }
        }

        return $items;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['total'];
        }
        return $total;
    }

    public function clear(): void
    {
        $this->getSession()->remove(self::CART_KEY);
    }
}