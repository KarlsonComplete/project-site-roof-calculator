<?php

namespace App\Entity;

use App\Repository\TypeOfSelectedMaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOfSelectedMaterialRepository::class)]
class TypeOfSelectedMaterial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'material_types')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MaterialType $materialType = null;

    #[ORM\OneToMany(mappedBy: 'typeOfSelectedMaterial', targetEntity: Coating::class, orphanRemoval: true)]
    private Collection $materials;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

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
     * @return Collection<int, Coating>
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Coating $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials->add($material);
            $material->setTypeOfSelectedMaterial($this);
        }

        return $this;
    }

    public function removeMaterial(Coating $material): self
    {
        if ($this->materials->removeElement($material)) {
            // set the owning side to null (unless already changed)
            if ($material->getTypeOfSelectedMaterial() === $this) {
                $material->setTypeOfSelectedMaterial(null);
            }
        }

        return $this;
    }
}
