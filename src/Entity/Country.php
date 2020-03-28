<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChampionShip", mappedBy="country")
     */
    private $championShips;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $code;

    public function __construct()
    {
        $this->championShips = new ArrayCollection();
    }

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|ChampionShip[]
     */
    public function getChampionShips(): Collection
    {
        return $this->championShips;
    }

    public function addChampionShip(ChampionShip $championShip): self
    {
        if (!$this->championShips->contains($championShip)) {
            $this->championShips[] = $championShip;
            $championShip->setCountry($this);
        }

        return $this;
    }

    public function removeChampionShip(ChampionShip $championShip): self
    {
        if ($this->championShips->contains($championShip)) {
            $this->championShips->removeElement($championShip);
            // set the owning side to null (unless already changed)
            if ($championShip->getCountry() === $this) {
                $championShip->setCountry(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
