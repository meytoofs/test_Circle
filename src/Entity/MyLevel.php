<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MyLevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MyLevelRepository::class)
 */
class MyLevel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $mySpriteSheet = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMySpriteSheet(): ?array
    {
        return $this->mySpriteSheet;
    }

    public function setMySpriteSheet(?array $mySpriteSheet): self
    {
        $this->mySpriteSheet = $mySpriteSheet;

        return $this;
    }
}
