<?php

namespace App\Entity;

use App\Repository\RoofListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: RoofListRepository::class)]
class RoofList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'roofLists')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank(message: 'You need to select your coating')]
    private ?Coating $coating = null;

    #[ORM\ManyToOne(inversedBy: 'roofLists')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank(message: 'You need to select your material_type')]
    private ?MaterialType $materialType = null;


    public function getId(): ?int
    {
        return $this->id;
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
