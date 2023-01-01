<?php

namespace App\Entity;

use App\Repository\CoatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoatingRepository::class)]
class Coating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'materials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeOfSelectedMaterial $typeOfSelectedMaterial = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeOfSelectedMaterial(): ?TypeOfSelectedMaterial
    {
        return $this->typeOfSelectedMaterial;
    }

    public function setTypeOfSelectedMaterial(?TypeOfSelectedMaterial $typeOfSelectedMaterial): self
    {
        $this->typeOfSelectedMaterial = $typeOfSelectedMaterial;

        return $this;
    }
}
