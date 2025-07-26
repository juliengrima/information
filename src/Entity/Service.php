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
    private Collection $agents;
    // private Collection $service;

    #[ORM\OneToOne(mappedBy: 'service', cascade: ['persist', 'remove'])]
    private ?Data $data = null;

    function __toString()
    {
        return $this->getLocalisation() . " | " . $this->getName() . " | ". $this->getData();
    }


    public function __construct()
    {
        $this->agents = new ArrayCollection();
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
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgents(Agents $agents): static
    {
        if (!$this->agents->contains($agents)) {
            $this->agents->add($agents);
            $agents->setService($this);
        }

        return $this;
    }

    public function removeAgents(Agents $agents): static
    {
        if ($this->agents->removeElement($agents)) {
            // set the owning side to null (unless already changed)
            if ($agents->getService() === $this) {
                $agents->setService(null);
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
