<?php

namespace App\Entity;

use App\Repository\TypeOfSelectMaterialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOfSelectMaterialRepository::class)]
class TypeOfSelectMaterial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'typesofselectmaterials')]
    private ?Coating $coating = null;

    #[ORM\ManyToOne(inversedBy: 'typesselectmaterials')]
    private ?MaterialType $materialType = null;

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

    public function getCoating(): ?Coating
    {
        return $this->coating;
    }

    public function setCoating(?Coating $coating): self
    {
        $this->coating = $coating;

        return $this;
    }

    public function getMaterialType(): ?MaterialType
    {
        return $this->materialType;
    }

    public function setMaterialType(?MaterialType $materialType): self
    {
        $this->materialType = $materialType;

        return $this;
    }
}
