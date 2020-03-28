<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClubRepository")
 */
class Club
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $creationDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Player", mappedBy="clubs")
     */
    private $players;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Coach", inversedBy="clubs")
     */
    private $coaches;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\President", inversedBy="clubs")
     */
    private $presidents;

    /** 
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="host") 
     * */
    protected $hostMatchs;

    /** 
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="visitor") 
     * */
    protected $visitorMatchs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Season", mappedBy="clubs")
     */
    private $seasons;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->coaches = new ArrayCollection();
        $this->presidents = new ArrayCollection();
        $this->hostMatchs = new ArrayCollection();
        $this->visitorMatchs = new ArrayCollection();
        $this->seasons = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

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
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addClub($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            $player->removeClub($this);
        }

        return $this;
    }

    /**
     * @return Collection|Coach[]
     */
    public function getCoaches(): Collection
    {
        return $this->coaches;
    }

    public function addCoach(Coach $coach): self
    {
        if (!$this->coaches->contains($coach)) {
            $this->coaches[] = $coach;
        }

        return $this;
    }

    public function removeCoach(Coach $coach): self
    {
        if ($this->coaches->contains($coach)) {
            $this->coaches->removeElement($coach);
        }

        return $this;
    }

    /**
     * @return Collection|President[]
     */
    public function getPresidents(): Collection
    {
        return $this->presidents;
    }

    public function addPresident(President $president): self
    {
        if (!$this->presidents->contains($president)) {
            $this->presidents[] = $president;
        }

        return $this;
    }

    public function removePresident(President $president): self
    {
        if ($this->presidents->contains($president)) {
            $this->presidents->removeElement($president);
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getHostMatchs(): Collection
    {
        return $this->hostMatchs;
    }

    public function addHostMatch(Match $hostMatch): self
    {
        if (!$this->hostMatchs->contains($hostMatch)) {
            $this->hostMatchs[] = $hostMatch;
            $hostMatch->setHost($this);
        }

        return $this;
    }

    public function removeHostMatch(Match $hostMatch): self
    {
        if ($this->hostMatchs->contains($hostMatch)) {
            $this->hostMatchs->removeElement($hostMatch);
            // set the owning side to null (unless already changed)
            if ($hostMatch->getHost() === $this) {
                $hostMatch->setHost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getVisitorMatchs(): Collection
    {
        return $this->visitorMatchs;
    }

    public function addVisitorMatch(Match $visitorMatch): self
    {
        if (!$this->visitorMatchs->contains($visitorMatch)) {
            $this->visitorMatchs[] = $visitorMatch;
            $visitorMatch->setVisitor($this);
        }

        return $this;
    }

    public function removeVisitorMatch(Match $visitorMatch): self
    {
        if ($this->visitorMatchs->contains($visitorMatch)) {
            $this->visitorMatchs->removeElement($visitorMatch);
            // set the owning side to null (unless already changed)
            if ($visitorMatch->getVisitor() === $this) {
                $visitorMatch->setVisitor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Season[]
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): self
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons[] = $season;
            $season->addClub($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): self
    {
        if ($this->seasons->contains($season)) {
            $this->seasons->removeElement($season);
            $season->removeClub($this);
        }

        return $this;
    }
}
