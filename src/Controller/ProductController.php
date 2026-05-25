<?php

namespace App\Controller;

use App\DTO\Response\ProductResponse;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    #[Route('/product/{id}', name: 'app_product_details', requirements: ['id' => '\d+'])]
    public function details(int $id): Response
    {
        $product = $this->productRepository->find($id)
            ?? throw $this->createNotFoundException('Product not found.');

        return $this->render('product/index.html.twig', [
            'product' => ProductResponse::fromEntity($product),
        ]);
    }
}