<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'service')]
    private ?Localisation $localisation = null;

    /**
     * @var Collection<int, Agents>
     */
    #[ORM\OneToMany(targetEntity: Agents::class, mappedBy: 'service')]
    private Collection $service;

    #[ORM\OneToOne(mappedBy: 'service', cascade: ['persist', 'remove'])]
    private ?Data $data = null;

    function __toString()
    {
        return $this->getLocalisation() . " | " . $this->getName() . " | ". $this->getData();
    }


    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLocalisation(): ?Localisation
    {
        return $this->localisation;
    }

    public function setLocalisation(?Localisation $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection<int, Agents>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Agents $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setService($this);
        }

        return $this;
    }

    public function removeService(Agents $service): static
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getService() === $this) {
                $service->setService(null);
            }
        }

        return $this;
    }

    public function getData(): ?Data
    {
        return $this->data;
    }

    public function setData(?Data $data): static
    {
        // unset the owning side of the relation if necessary
        if ($data === null && $this->data !== null) {
            $this->data->setService(null);
        }

        // set the owning side of the relation if necessary
        if ($data !== null && $data->getService() !== $this) {
            $data->setService($this);
        }

        $this->data = $data;

        return $this;
    }
}
