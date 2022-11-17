<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
#[UniqueEntity('libelle')]

class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Merci d'introduire LIBELLE TACHE")]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Merci d'introduire DESCRIPTION TACHE")]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutTache = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan('today')]
    private ?\DateTimeInterface $dateFinTache = null;

    #[ORM\Column(length: 255)]
    private ?string $status = "En ATTENTE";

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Employe $idEmp = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Projet $idProjet = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebutTache(): ?\DateTimeInterface
    {
        return $this->dateDebutTache;
    }

    public function setDateDebutTache(\DateTimeInterface $dateDebutTache): self
    {
        $this->dateDebutTache = $dateDebutTache;

        return $this;
    }

    public function getDateFinTache(): ?\DateTimeInterface
    {
        return $this->dateFinTache;
    }

    public function setDateFinTache(\DateTimeInterface $dateFinTache): self
    {
        $this->dateFinTache = $dateFinTache;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIdEmp(): ?Employe
    {
        return $this->idEmp;
    }

    public function setIdEmp(?Employe $idEmp): self
    {
        $this->idEmp = $idEmp;

        return $this;
    }

    public function getIdProjet(): ?Projet
    {
        return $this->idProjet;
    }

    public function setIdProjet(?Projet $idProjet): self
    {
        $this->idProjet = $idProjet;

        return $this;
    }

    
}
