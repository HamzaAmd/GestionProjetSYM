<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[UniqueEntity('codeProjet')]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Merci d'introduire le CODE PROJET")]
    #[Assert\Length(
        min: 9,
        minMessage: 'le CODE PROJET doit contenir au min {{ limit }} caractère ',
        )]
    private ?string $codeProjet = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Merci d'introduire le NOM DU PROJET")]
    private ?string $nomProjet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutProjet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan('today')]
    private ?\DateTimeInterface $dateFinProjet = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?Equipe $idEqu = null;

    #[ORM\OneToMany(mappedBy: 'idProjet', targetEntity: Tache::class)]
    private Collection $taches;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeProjet(): ?string
    {
        return $this->codeProjet;
    }

    public function setCodeProjet(string $codeProjet): self
    {
        $this->codeProjet = $codeProjet;

        return $this;
    }

    public function getNomProjet(): ?string
    {
        return $this->nomProjet;
    }

    public function setNomProjet(string $nomProjet): self
    {
        $this->nomProjet = $nomProjet;

        return $this;
    }

    public function getDateDebutProjet(): ?\DateTimeInterface
    {
        return $this->dateDebutProjet;
    }

    public function setDateDebutProjet(\DateTimeInterface $dateDebutProjet): self
    {
        $this->dateDebutProjet = $dateDebutProjet;

        return $this;
    }

    public function getDateFinProjet(): ?\DateTimeInterface
    {
        return $this->dateFinProjet;
    }

    public function setDateFinProjet(\DateTimeInterface $dateFinProjet): self
    {
        $this->dateFinProjet = $dateFinProjet;

        return $this;
    }

    public function getIdEqu(): ?Equipe
    {
        return $this->idEqu;
    }

    public function setIdEqu(?Equipe $idEqu): self
    {
        $this->idEqu = $idEqu;

        return $this;
    }

    public function __toString() {
        return $this->id;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->setIdProjet($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getIdProjet() === $this) {
                $tach->setIdProjet(null);
            }
        }

        return $this;
    }
}
