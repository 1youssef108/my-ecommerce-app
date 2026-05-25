<?php

namespace App\Controller;

use App\DTO\Response\CategoryResponse;
use App\DTO\Response\ProductResponse;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly ProductRepository  $productRepository,
    ) {}

    #[Route('/categories', name: 'app_categories')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => CategoryResponse::fromCollection(
                $this->categoryRepository->findAll()
            ),
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_products', requirements: ['id' => '\d+'])]
    public function productsByCategory(int $id): Response
    {
        $category = $this->categoryRepository->find($id)
            ?? throw $this->createNotFoundException('Category not found.');

        return $this->render('category/products.html.twig', [
            'category' => CategoryResponse::fromEntity($category),
            'products' => ProductResponse::fromCollection(
                $this->productRepository->findBy(['category' => $category])
            ),
        ]);
    }
}