<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CoatingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'coating', targetEntity: MaterialType::class)]
    private Collection $materialtypes;

    public function __construct()
    {
        $this->materialtypes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
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
     * @return Collection<int, MaterialType>
     */
    public function getMaterialtypes(): Collection
    {
        return $this->materialtypes;
    }

    public function addMaterialtype(MaterialType $materialtype): self
    {
        if (!$this->materialtypes->contains($materialtype)) {
            $this->materialtypes->add($materialtype);
            $materialtype->setCoating($this);
        }

        return $this;
    }

    public function removeMaterialtype(MaterialType $materialtype): self
    {
        if ($this->materialtypes->removeElement($materialtype)) {
            // set the owning side to null (unless already changed)
            if ($materialtype->getCoating() === $this) {
                $materialtype->setCoating(null);
            }
        }

        return $this;
    }

}
