<?php

namespace App\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * DTO for incoming registration data.
 *
 * Decouples the HTTP form input from the User Entity (SRP).
 * Validation lives here, keeping the Entity clean.
 */
final class RegistrationRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Full name is required.')]
        #[Assert\Length(max: 255)]
        public readonly string $fullName,

        #[Assert\NotBlank(message: 'Email is required.')]
        #[Assert\Email(message: 'Please enter a valid email address.')]
        public readonly string $email,

        #[Assert\NotBlank(message: 'Password is required.')]
        #[Assert\Length(
            min: 6,
            minMessage: 'Password must be at least {{ limit }} characters.'
        )]
        public readonly string $plainPassword,
    ) {}
}