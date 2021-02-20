<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\SportPracticeBySportsman;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Sportsman
 *
 * @ORM\Table(
 *     name="sd_personne",
 *     uniqueConstraints={
 *       @ORM\UniqueConstraint(
 *         name="UNIQ_134CB9355126AC48",
 *         columns={"mail"}
 *       )
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SportsmanRepository")
 */
class Sportsman
{

    /**
     * @var int
     *
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ID;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="nom",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    private $Nom;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="prenom",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    private $Prenom;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="departement",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    private $Departement;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="mail",
     *     type="string",
     *     length=320,
     *     nullable=false
     * )
     */
    private $Email;

    /**
     * @ORM\OneToMany(
     *     targetEntity="SportPracticeBySportsman",
     *     mappedBy="SportsmanData"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(
     *     name="id",
     *     referencedColumnName="id_personne_id",
     *     nullable=false
     *   )
     * })
     */
    private $PracticingSportsList;

    public function __construct()
    {
        $this->PracticingSportsList = new ArrayCollection();
    }

    public function getID(): ?int
    {
        return $this->ID;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->Departement;
    }

    public function setDepartement(string $Departement): self
    {
        $this->Departement = $Departement;

        return $this;
    }

    public function __toString(): ?string
    {
        return getDepartement();
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection|SportPracticeBySportsman[]
     */
    public function getPracticingSportsList(): Collection
    {
        return $this->PracticingSportsList;
    }

    public function addPracticingSportsList(SportPracticeBySportsman $practicingSportsList): self
    {
        if (!$this->PracticingSportsList->contains($practicingSportsList)) {
            $this->PracticingSportsList[] = $practicingSportsList;
            $practicingSportsList->setSportsmanData($this);
        }

        return $this;
    }

    public function removePracticingSportsList(SportPracticeBySportsman $practicingSportsList): self
    {
        if ($this->PracticingSportsList->removeElement($practicingSportsList)) {
            // set the owning side to null (unless already changed)
            if ($practicingSportsList->getSportsmanData() === $this) {
                $practicingSportsList->setSportsmanData(null);
            }
        }

        return $this;
    }
}
