<?php

namespace App\Entity;

use App\Repository\MaterialTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialTypeRepository::class)]
class MaterialType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'materialType', targetEntity: TypeOfSelectedMaterial::class, orphanRemoval: true)]
    private Collection $material_types;

    public function __construct()
    {
        $this->material_types = new ArrayCollection();
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

    /**
     * @return Collection<int, TypeOfSelectedMaterial>
     */
    public function getMaterialTypes(): Collection
    {
        return $this->material_types;
    }

    public function addMaterialType(TypeOfSelectedMaterial $materialType): self
    {
        if (!$this->material_types->contains($materialType)) {
            $this->material_types->add($materialType);
            $materialType->setMaterialType($this);
        }

        return $this;
    }

    public function removeMaterialType(TypeOfSelectedMaterial $materialType): self
    {
        if ($this->material_types->removeElement($materialType)) {
            // set the owning side to null (unless already changed)
            if ($materialType->getMaterialType() === $this) {
                $materialType->setMaterialType(null);
            }
        }

        return $this;
    }
}
