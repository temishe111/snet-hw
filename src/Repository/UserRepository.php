<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

readonly class UserRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @param string $user_id
     * @return string
     * @throws \Doctrine\DBAL\Exception
     */
    public function getUserPassword(string $user_id): string
    {
        $sql = '
            SELECT password FROM users
            WHERE user_id = ?
        ';

        $connection = $this->entityManager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $user_id);

        $result = $stmt->executeQuery()->fetchAssociative();

        if (!$result) {
            throw new EntityNotFoundException('Пользователь не найден');
        }

        return $result['password'];
    }

    /**
     * @param string $user_id
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    public function getUserProfile(string $user_id): array
    {
        $sql = '
            SELECT first_name, second_name, birthdate, biography, city FROM users
            WHERE user_id = ?
        ';

        $connection = $this->entityManager->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $user_id);

        $result = $stmt->executeQuery()->fetchAssociative();

        if (!$result) {
            throw new EntityNotFoundException('Пользователь не найден');
        }

        return $result;
    }
}
