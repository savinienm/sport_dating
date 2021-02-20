<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SportPracticeBySportsman
 *
 * @ORM\Table(
 *     name="sd_pratique",
 *     indexes={
 *       @ORM\Index(
 *         name="IDX_1D70C75BFCA3506D",
 *         columns={"id_sport_id"}
 *       ),
 *       @ORM\Index(
 *         name="IDX_1D70C75BBA091CE5",
 *         columns={"id_personne_id"}
 *       )
 *     },
 *     uniqueConstraints={
 *       @ORM\UniqueConstraint(
 *         name="niveau_sport_unique",
 *         columns={"id_personne_id", "id_sport_id"}
 *       )
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SportPracticeBySportsmanRepository")
 */
class SportPracticeBySportsman
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
     *     name="niveau",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    private $Niveau;

    /**
     * @var \Sportsman
     *
     * @Assert\Valid
     *
     * @ORM\ManyToOne(
     *     targetEntity="Sportsman",
     *     cascade={"persist", "remove"},
     *     inversedBy="PracticingSportsList"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(
     *     name="id_personne_id",
     *     referencedColumnName="id",
     *     nullable=false
     *   )
     * })
     */
    private $SportsmanData;

    /**
     * @var \Sport
     *
     * @Assert\Valid
     *
     * @ORM\ManyToOne(
     *     targetEntity="Sport",
     *     cascade={"persist", "remove"},
     *     inversedBy="PracticedByList"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(
     *     name="id_sport_id",
     *     referencedColumnName="id",
     *     nullable=false
     *   )
     * })
     */
    private $SportData;

    public function getID(): ?int
    {
        return $this->ID;
    }

    public function getNiveau(): ?string
    {
        return $this->Niveau;
    }

    public function setNiveau(string $Niveau): self
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getSportsmanData(): ?Sportsman
    {
        return $this->SportsmanData;
    }

    public function setSportsmanData(?Sportsman $SportsmanData): self
    {
        $this->SportsmanData = $SportsmanData;

        return $this;
    }

    public function getSportData(): ?Sport
    {
        return $this->SportData;
    }

    public function setSportData(?Sport $SportData): self
    {
        $this->SportData = $SportData;

        return $this;
    }
}
