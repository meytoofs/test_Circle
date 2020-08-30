<?php

namespace App\Entity;

use App\Repository\NoteHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteHistoryRepository::class)
 */
class NoteHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="noteHistories")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=level::class, inversedBy="noteHistories")
     */
    private $level_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
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

    public function getLevelId(): ?level
    {
        return $this->level_id;
    }

    public function setLevelId(?level $level_id): self
    {
        $this->level_id = $level_id;

        return $this;
    }
}
