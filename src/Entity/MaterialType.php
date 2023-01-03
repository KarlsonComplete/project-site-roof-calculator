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

    #[ORM\ManyToOne(inversedBy: 'materialtypes')]
    private ?Coating $coating = null;

    #[ORM\OneToMany(mappedBy: 'materialType', targetEntity: TypeOfSelectMaterial::class)]
    private Collection $typesselectmaterials;

    public function __construct()
    {
        $this->typesselectmaterials = new ArrayCollection();
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

    public function getCoating(): ?Coating
    {
        return $this->coating;
    }

    public function setCoating(?Coating $coating): self
    {
        $this->coating = $coating;

        return $this;
    }

    /**
     * @return Collection<int, TypeOfSelectMaterial>
     */
    public function getTypesselectmaterials(): Collection
    {
        return $this->typesselectmaterials;
    }

    public function addTypesselectmaterial(TypeOfSelectMaterial $typesselectmaterial): self
    {
        if (!$this->typesselectmaterials->contains($typesselectmaterial)) {
            $this->typesselectmaterials->add($typesselectmaterial);
            $typesselectmaterial->setMaterialType($this);
        }

        return $this;
    }

    public function removeTypesselectmaterial(TypeOfSelectMaterial $typesselectmaterial): self
    {
        if ($this->typesselectmaterials->removeElement($typesselectmaterial)) {
            // set the owning side to null (unless already changed)
            if ($typesselectmaterial->getMaterialType() === $this) {
                $typesselectmaterial->setMaterialType(null);
            }
        }

        return $this;
    }
}
