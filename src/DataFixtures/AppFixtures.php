<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer les catégories
        $electronics = new Category();
        $electronics->setName('Electronics');
        $electronics->setDescription('Headphones, speakers, gadgets and more');
        $manager->persist($electronics);

        $fashion = new Category();
        $fashion->setName('Fashion');
        $fashion->setDescription('Clothing, accessories and footwear');
        $manager->persist($fashion);

        $homeGarden = new Category();
        $homeGarden->setName('Home & Garden');
        $homeGarden->setDescription('Furniture, decor and gardening tools');
        $manager->persist($homeGarden);

        $sports = new Category();
        $sports->setName('Sports & Fitness');
        $sports->setDescription('Workout gear, yoga mats and equipment');
        $manager->persist($sports);

        $books = new Category();
        $books->setName('Books');
        $books->setDescription('Fiction, non-fiction and educational');
        $manager->persist($books);

        // Créer les produits
        $p1 = new Product();
        $p1->setName('Wireless Headphones');
        $p1->setDescription('Experience premium sound quality with our wireless headphones. Featuring advanced noise cancellation technology and up to 30 hours of battery life.');
        $p1->setPrice('79.99');
        $p1->setStock(15);
        $p1->setCategory($electronics);
        $manager->persist($p1);

        $p2 = new Product();
        $p2->setName('Classic Leather Jacket');
        $p2->setDescription('Premium leather jacket with a classic design. Perfect for casual and semi-formal occasions.');
        $p2->setPrice('149.99');
        $p2->setStock(8);
        $p2->setCategory($fashion);
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setName('Smart Plant Sensor');
        $p3->setDescription('Monitor your plants health with this smart sensor. Tracks moisture, light, and temperature.');
        $p3->setPrice('34.99');
        $p3->setStock(20);
        $p3->setCategory($homeGarden);
        $manager->persist($p3);

        $p4 = new Product();
        $p4->setName('Yoga Mat Premium');
        $p4->setDescription('Non-slip premium yoga mat with extra thickness for maximum comfort during your workout.');
        $p4->setPrice('29.99');
        $p4->setStock(25);
        $p4->setCategory($sports);
        $manager->persist($p4);

        $p5 = new Product();
        $p5->setName('Bluetooth Speaker');
        $p5->setDescription('Portable bluetooth speaker with 360° sound and waterproof design. Perfect for outdoor use.');
        $p5->setPrice('59.99');
        $p5->setStock(12);
        $p5->setCategory($electronics);
        $manager->persist($p5);

        $p6 = new Product();
        $p6->setName('Web Development Guide');
        $p6->setDescription('Complete guide to modern web development. Covers HTML, CSS, JavaScript and more.');
        $p6->setPrice('24.99');
        $p6->setStock(30);
        $p6->setCategory($books);
        $manager->persist($p6);

        $p7 = new Product();
        $p7->setName('Wireless Mouse');
        $p7->setDescription('Ergonomic wireless mouse with long battery life and precise tracking.');
        $p7->setPrice('29.99');
        $p7->setStock(18);
        $p7->setCategory($electronics);
        $manager->persist($p7);

        $p8 = new Product();
        $p8->setName('Mechanical Keyboard');
        $p8->setDescription('Tactile mechanical keyboard with RGB lighting and programmable keys.');
        $p8->setPrice('89.99');
        $p8->setStock(10);
        $p8->setCategory($electronics);
        $manager->persist($p8);

        $manager->flush();
    }
}