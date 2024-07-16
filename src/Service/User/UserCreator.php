<?php

namespace App\Service\User;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Factory\UuidFactory;

class UserCreator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UuidFactory            $uuidFactory,
        private readonly UserPasswordHasher     $hasher,
    ){}

    /**
     * @param User $user
     * @return int
     * @throws \Doctrine\DBAL\Exception
     */
    public function create(User $user): string
    {
        $sql = '
            INSERT INTO users (user_id, first_name, second_name, birthdate, biography, city, password) 
            VALUES (?,?,?,?,?,?,?) 
        ';

        $uuid = $this->uuidFactory->create();

        $connection = $this->entityManager->getConnection();
        $stmt = $connection->prepare($sql);

        $stmt->bindValue(1, $uuid->toString());
        $stmt->bindValue(2, $user->getFirstName());
        $stmt->bindValue(3, $user->getSecondName());
        $stmt->bindValue(4, $user->getBirthdate());
        $stmt->bindValue(5, $user->getBiography());
        $stmt->bindValue(6, $user->getCity());
        $stmt->bindValue(7, $this->hasher->hash($user->getPassword()));

        $stmt->executeQuery();

        return $uuid;
    }
}
