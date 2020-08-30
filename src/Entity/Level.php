<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total_score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featured_image;

    /**
     * @ORM\OneToMany(targetEntity=NoteHistory::class, mappedBy="level_id")
     */
    private $noteHistories;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;


    public function __construct()
    {
        $this->noteHistories = new ArrayCollection();
    }

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTotalScore(): ?int
    {
        return $this->total_score;
    }

    public function getTotal()
    {
        $total = 0;
        
        foreach($this->getNoteHistories() as $history)
        {
            $total += $history->getScore();
        }
        return $total;
    }

    public function getAvg(){
        $total = count($this->getNoteHistories());
        
        if ($total == 0){
            return 0;
        }
        return $this->getTotal() / $total;
    }
    
    public function setTotalScore(?int $total_score): self
    {
        $this->total_score = $total_score;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(?string $featured_image): self
    {
        $this->featured_image = $featured_image;

        return $this;
    }

    /**
     * @return Collection|NoteHistory[]
     */
    public function getNoteHistories(): Collection
    {
        return $this->noteHistories;
    }

    public function addNoteHistory(NoteHistory $noteHistory): self
    {
        if (!$this->noteHistories->contains($noteHistory)) {
            $this->noteHistories[] = $noteHistory;
            $noteHistory->setLevelId($this);
        }

        return $this;
    }

    public function removeNoteHistory(NoteHistory $noteHistory): self
    {
        if ($this->noteHistories->contains($noteHistory)) {
            $this->noteHistories->removeElement($noteHistory);
            // set the owning side to null (unless already changed)
            if ($noteHistory->getLevelId() === $this) {
                $noteHistory->setLevelId(null);
            }
        }

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
