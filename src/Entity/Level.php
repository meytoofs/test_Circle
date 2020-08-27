<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LevelRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 * @ApiResource
 */
class Level
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="levels")
     */
    private $user_id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $Spritesheet = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getSpritesheet(): ?array
    {
        return $this->Spritesheet;
    }

    public function setSpritesheet(?array $Spritesheet): self
    {
        $this->Spritesheet = $Spritesheet;

        return $this;
    }
}
