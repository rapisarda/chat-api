<?php

declare(strict_types=1);

namespace App\Entity\Chat;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ApiResource()
 */
class Chanel
{
    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @var Message[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Chat\Message", mappedBy="channel")
     */
    private array $messages;

    /**
     * @var User[]
     */
    private array $users;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Message[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param Message[] $messages
     */
    public function setMessages(array $messages): void
    {
        $this->messages = $messages;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param User[] $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}
