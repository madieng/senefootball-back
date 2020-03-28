<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="`match`")
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 * @UniqueEntity(
 *     fields={"host", "visitor", "date"},
 *     message="Le match existe déjà."
 * )
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $hour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="hostMatchs") 
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id", nullable=false) 
     */
    protected $host;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="visitorMatchs") 
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id", nullable=false) 
     */
    protected $visitor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getHost(): ?Club
    {
        return $this->host;
    }

    public function setHost(?Club $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getVisitor(): ?Club
    {
        return $this->visitor;
    }

    public function setVisitor(?Club $visitor): self
    {
        $this->visitor = $visitor;

        return $this;
    }
}
