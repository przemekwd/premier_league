<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubPlayerRepository")
 */
class ClubPlayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="clubs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTo;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $transferFee;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $transferType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(?\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTransferFee(): ?string
    {
        return $this->transferFee;
    }

    public function setTransferFee(?string $transferFee): self
    {
        $this->transferFee = $transferFee;

        return $this;
    }

    public function getTransferType(): ?string
    {
        return $this->transferType;
    }

    public function setTransferType(string $transferType): self
    {
        $this->transferType = $transferType;

        return $this;
    }
}
