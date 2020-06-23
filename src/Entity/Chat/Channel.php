<?php

declare(strict_types=1);

namespace App\Entity\Chat;

use App\Entity\CreatorAware;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Channel implements CreatorAware
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
     * @var Collection|Message[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Chat\Message", mappedBy="channel")
     */
    private Collection $messages;

    /**
     * @var Collection|User[]
     *
     * @Groups({"channel"})
     * @Assert\Count(min="2")
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private Collection $users;

    /**
     * @var User
     *
     * @Assert\NotNull()
     * @Groups({"channel"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private User $creator;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function setMessages(iterable $messages): void
    {
        $this->messages->clear();
        foreach ($messages as $message) {
            $this->addMessage($message);
        }
    }

    public function addMessage(Message $message): void
    {
        $this->messages->add($message);
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param Collection|User[] $users
     */
    public function setUsers(iterable $users): void
    {
        $this->users->clear();
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }

    public function addUser(User $user): void
    {
        $this->users->add($user);
    }

    /**
     * @return User
     */
    public function getCreator(): User
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     */
    public function setCreator(User $creator): void
    {
        $this->users->add($creator);
        $this->creator = $creator;
    }
}
