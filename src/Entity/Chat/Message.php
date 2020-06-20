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
class Message
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
     * @var Chanel
     *
     * @ORM\ManyToOne(targetEntity="Chanel", inversedBy="messages")
     */
    private Chanel $channel;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private ?User $user;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     */
    private ?string $body;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Chanel
     */
    public function getChannel(): Chanel
    {
        return $this->channel;
    }

    /**
     * @param Chanel $channel
     */
    public function setChannel(Chanel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
}
