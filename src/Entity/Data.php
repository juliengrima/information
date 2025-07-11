<?php

namespace App\Entity;

use App\Repository\DataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRepository::class)]
class Data
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $service_data = null;

    #[ORM\OneToOne(inversedBy: 'data', cascade: ['persist', 'remove'])]
    private ?Service $service = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceData(): ?string
    {
        return $this->service_data;
    }

    public function setServiceData(?string $service_data): static
    {
        $this->service_data = $service_data;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }
}
