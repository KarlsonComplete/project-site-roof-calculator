<?php

namespace App\Entity;

use App\Repository\RoofListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoofListRepository::class)]
class RoofList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $coating = null;

    #[ORM\Column(length: 55)]
    private ?string $materialType = null;

    #[ORM\ManyToOne(inversedBy: 'roofLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Coating $coatings = null;

    #[ORM\ManyToOne(inversedBy: 'roofLists')]
    private ?MaterialType $materialTypes = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoating(): ?string
    {
        return $this->coating;
    }

    public function setCoating(string $coating): self
    {
        $this->coating = $coating;

        return $this;
    }

    public function getMaterialType(): ?string
    {
        return $this->materialType;
    }

    public function setMaterialType(string $materialType): self
    {
        $this->materialType = $materialType;

        return $this;
    }

    public function getCoatings(): ?Coating
    {
        return $this->coatings;
    }

    public function setCoatings(?Coating $coatings): self
    {
        $this->coatings = $coatings;

        return $this;
    }

    public function getMaterialTypes(): ?MaterialType
    {
        return $this->materialTypes;
    }

    public function setMaterialTypes(?MaterialType $materialTypes): self
    {
        $this->materialTypes = $materialTypes;

        return $this;
    }

}
