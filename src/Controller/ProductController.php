<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product_details')]
    public function details(int $id): Response
    {
        return $this->render('product/index.html.twig', [
            'id' => $id,
        ]);
    }
}
