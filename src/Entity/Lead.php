<?php

namespace App\Entity;

use App\Repository\LeadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeadRepository::class)
 * @ORM\Table(name="`lead`")
 */
class Lead
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domain;

    /**
     * @ORM\Column(type="boolean")
     */
    private $conversion_status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $broadcast_status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="leads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $created_by;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getConversionStatus(): ?bool
    {
        return $this->conversion_status;
    }

    public function setConversionStatus(bool $conversion_status): self
    {
        $this->conversion_status = $conversion_status;

        return $this;
    }

    public function getBroadcastStatus(): ?bool
    {
        return $this->broadcast_status;
    }

    public function setBroadcastStatus(bool $broadcast_status): self
    {
        $this->broadcast_status = $broadcast_status;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }
}
