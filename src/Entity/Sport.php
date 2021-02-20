<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\SportPracticeBySportsman;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Sport
 *
 * @ORM\Table(
 *     name="sd_sport",
 *     uniqueConstraints={
 *       @ORM\UniqueConstraint(
 *         name="UNIQ_197B8301B07D7347",
 *         columns={"nom_sport"}
 *       )
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SportRepository")
 */
class Sport
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
     *     name="nom_sport",
     *     type="string",
     *     length=320,
     *     nullable=false
     * )
     */
    private $Loisir;

    public function __toString(){
        return $this->Loisir;
    }

    /**
     * @ORM\OneToMany(
     *     targetEntity="SportPracticeBySportsman",
     *     mappedBy="SportData"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(
     *     name="id",
     *     referencedColumnName="id_sport_id",
     *     nullable=false
     *   )
     * })
     */
    private $PracticedByList;

    public function __construct()
    {
        $this->PracticedByList = new ArrayCollection();
    }

    public function getID(): ?int
    {
        return $this->ID;
    }

    public function getLoisir(): ?string
    {
        return $this->Loisir;
    }

    public function setLoisir(string $Loisir): self
    {
        $this->Loisir = $Loisir;

        return $this;
    }

    /**
     * @return Collection|SportPracticeBySportsman[]
     */
    public function getPracticedByList(): Collection
    {
        return $this->PracticedByList;
    }

    public function addPracticedByList(SportPracticeBySportsman $practicedByList): self
    {
        if (!$this->PracticedByList->contains($practicedByList)) {
            $this->PracticedByList[] = $practicedByList;
            $practicedByList->setSportData($this);
        }

        return $this;
    }

    public function removePracticedByList(SportPracticeBySportsman $practicedByList): self
    {
        if ($this->PracticedByList->removeElement($practicedByList)) {
            // set the owning side to null (unless already changed)
            if ($practicedByList->getSportData() === $this) {
                $practicedByList->setSportData(null);
            }
        }

        return $this;
    }
}
