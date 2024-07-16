<?php

namespace App\Entity\User;

use Symfony\Component\Validator\Constraints as Assert;

class User
{
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private string $firstName;
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your second name must be at least {{ limit }} characters long',
        maxMessage: 'Your second name cannot be longer than {{ limit }} characters',
    )]
    private string $secondName;
    #[Assert\Date]
    private string $birthdate;
    #[Assert\Length(
        min: 2,
        max: 2000,
        minMessage: 'Your biography must be at least {{ limit }} characters long',
        maxMessage: 'Your biography cannot be longer than {{ limit }} characters',
    )]
    private string $biography;
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your city must be at least {{ limit }} characters long',
        maxMessage: 'Your city cannot be longer than {{ limit }} characters',
    )]
    private string $city;
    #[Assert\NotBlank]
    private string $password;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    /**
     * @return string
     */
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    /**
     * @param string $birthdate
     */
    public function setBirthdate(string $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     */
    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
