<?php

namespace App\DTO\Response;

use App\Entity\Product;

/**
 * Exposes only the Product fields needed by the view layer.
 * Decouples the Twig templates from the Doctrine Entity (SRP).
 */
final class ProductResponse
{
    public readonly int     $id;
    public readonly string  $name;
    public readonly ?string $description;
    public readonly string  $price;
    public readonly int     $stock;
    public readonly bool    $inStock;
    public readonly ?string $image;
    public readonly ?string $categoryName;

    private function __construct(Product $product)
    {
        $this->id           = $product->getId();
        $this->name         = $product->getName();
        $this->description  = $product->getDescription();
        $this->price        = $product->getPrice();
        $this->stock        = $product->getStock();
        $this->inStock      = $product->getStock() > 0;
        $this->image        = $product->getImage();
        $this->categoryName = $product->getCategory()?->getName();
    }

    public static function fromEntity(Product $product): self
    {
        return new self($product);
    }

    /**
     * @param  Product[] $products
     * @return self[]
     */
    public static function fromCollection(array $products): array
    {
        return array_map(
            static fn(Product $p): self => self::fromEntity($p),
            $products
        );
    }
}