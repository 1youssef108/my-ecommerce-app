<?php

namespace App\Service;

use App\DTO\Request\RegistrationRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Handles the user registration business logic.
 *
 * Accepts a RegistrationRequest DTO instead of raw form data,
 * keeping this service reusable and testable (SRP, DIP).
 */
class RegistrationService
{
    public function __construct(
        private readonly EntityManagerInterface      $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function register(RegistrationRequest $request): User
    {
        $user = new User();
        $user->setFullName($request->fullName);
        $user->setEmail($request->email);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $request->plainPassword);
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}