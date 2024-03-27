<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAchat = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToMany(targetEntity: Billet::class, inversedBy: 'achats')]
    private Collection $billetsAchetes;

    public function __construct()
    {
        $this->billetsAchetes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Billet>
     */
    public function getBilletsAchetes(): Collection
    {
        return $this->billetsAchetes;
    }

    public function addBilletsAchete(Billet $billetsAchete): static
    {
        if (!$this->billetsAchetes->contains($billetsAchete)) {
            $this->billetsAchetes->add($billetsAchete);
        }

        return $this;
    }

    public function removeBilletsAchete(Billet $billetsAchete): static
    {
        $this->billetsAchetes->removeElement($billetsAchete);

        return $this;
    }
}
