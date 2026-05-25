<?php

namespace App\Controller;

use App\Cart\CartHandler;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    public function __construct(
        private CartHandler $cartHandler,
    ) {}

    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $this->cartHandler->getCartItems(),
            'total' => $this->cartHandler->getCartTotal(),
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add', methods: ['POST'])]
    public function add(
        int $id,
        Request $request,
        ProductRepository $productRepository
    ): Response {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found!');
        }

        $quantity = max(1, (int) $request->request->get('quantity', 1));
        $this->cartHandler->addToCart($product, $quantity);

        $this->addFlash('success', 'Product added to cart! 🛒');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove', methods: ['POST'])]
    public function remove(int $id): Response
    {
        $this->cartHandler->removeFromCart($id);
        $this->addFlash('success', 'Product removed from cart.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/clear', name: 'app_cart_clear', methods: ['POST'])]
    public function clear(): Response
    {
        $this->cartHandler->clearCart();
        $this->addFlash('success', 'Cart cleared.');

        return $this->redirectToRoute('app_cart');
    }
}