<?php

namespace App\DTO\Response;

use App\Entity\Category;

/**
 * Exposes only the Category fields needed by the view layer.
 */
final class CategoryResponse
{
    public readonly int     $id;
    public readonly string  $name;
    public readonly ?string $description;
    public readonly int     $productCount;

    private function __construct(Category $category)
    {
        $this->id           = $category->getId();
        $this->name         = $category->getName();
        $this->description  = $category->getDescription();
        $this->productCount = $category->getProducts()->count();
    }

    public static function fromEntity(Category $category): self
    {
        return new self($category);
    }

    /**
     * @param  Category[] $categories
     * @return self[]
     */
    public static function fromCollection(array $categories): array
    {
        return array_map(
            static fn(Category $c): self => self::fromEntity($c),
            $categories
        );
    }
}