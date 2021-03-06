<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="club")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Manager", inversedBy="club", cascade={"persist", "remove"})
     */
    private $manager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClubManager", mappedBy="club")
     */
    private $managers;


    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->managers = new ArrayCollection();
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
            $player->setClub($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getClub() === $this) {
                $player->setClub(null);
            }
        }

        return $this;
    }

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection|ClubManager[]
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(ClubManager $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers[] = $manager;
            $manager->setClub($this);
        }

        return $this;
    }

    public function removeManager(ClubManager $manager): self
    {
        if ($this->managers->contains($manager)) {
            $this->managers->removeElement($manager);
            // set the owning side to null (unless already changed)
            if ($manager->getClub() === $this) {
                $manager->setClub(null);
            }
        }

        return $this;
    }

}
