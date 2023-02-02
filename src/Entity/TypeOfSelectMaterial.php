<?php

namespace App\Entity;

use App\Repository\TypeOfSelectMaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'typesselectmaterials')]
    private ?MaterialType $materialType = null;

    #[ORM\OneToMany(mappedBy: 'typeOfSelectMaterial', targetEntity: RoofList::class)]
    private Collection $roofLists;

    public function __construct()
    {
        $this->roofLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->title;
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

    public function getMaterialType(): ?MaterialType
    {
        return $this->materialType;
    }

    public function setMaterialType(?MaterialType $materialType): self
    {
        $this->materialType = $materialType;

        return $this;
    }

    /**
     * @return Collection<int, RoofList>
     */
    public function getRoofLists(): Collection
    {
        return $this->roofLists;
    }

    public function addRoofList(RoofList $roofList): self
    {
        if (!$this->roofLists->contains($roofList)) {
            $this->roofLists->add($roofList);
            $roofList->setTypeOfSelectMaterial($this);
        }

        return $this;
    }

    public function removeRoofList(RoofList $roofList): self
    {
        if ($this->roofLists->removeElement($roofList)) {
            // set the owning side to null (unless already changed)
            if ($roofList->getTypeOfSelectMaterial() === $this) {
                $roofList->setTypeOfSelectMaterial(null);
            }
        }

        return $this;
    }
}
