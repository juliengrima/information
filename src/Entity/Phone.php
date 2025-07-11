<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
class Phone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $number = null;

    #[ORM\ManyToOne(inversedBy: 'phones')]
    private ?Localisation $localistaion = null;

    #[ORM\OneToOne(mappedBy: 'phone', cascade: ['persist', 'remove'])]
    private ?Agents $agents = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getLocalistaion(): ?Localisation
    {
        return $this->localistaion;
    }

    public function setLocalistaion(?Localisation $localistaion): static
    {
        $this->localistaion = $localistaion;

        return $this;
    }

    public function getAgents(): ?Agents
    {
        return $this->agents;
    }

    public function setAgents(?Agents $agents): static
    {
        // unset the owning side of the relation if necessary
        if ($agents === null && $this->agents !== null) {
            $this->agents->setPhone(null);
        }

        // set the owning side of the relation if necessary
        if ($agents !== null && $agents->getPhone() !== $this) {
            $agents->setPhone($this);
        }

        $this->agents = $agents;

        return $this;
    }
}
