<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig');
    }

    #[Route('/category/{id}', name: 'app_category_products')]
    public function productsByCategory(int $id): Response
    {
        return $this->render('category/products.html.twig', [
            'id' => $id,
        ]);
    }
}