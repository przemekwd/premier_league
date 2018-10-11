<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManagerRepository")
 */
class Manager
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $birthPlace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Assert\File(mimeTypes={"image/png"})
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nation", inversedBy="managers")
     */
    private $nation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Club", mappedBy="manager", cascade={"persist", "remove"})
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClubManager", mappedBy="manager")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNation(): ?Nation
    {
        return $this->nation;
    }

    public function setNation(?Nation $nation): self
    {
        $this->nation = $nation;

        return $this;
    }

    public function getFullname()
    {
        return $this->firstname . ($this->name ? ' "' . $this->name . '" ' : ' ') . $this->lastname;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile($imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        // set (or unset) the owning side of the relation if necessary
        $newManager = $club === null ? null : $this;
        if ($newManager !== $club->getManager()) {
            $club->setManager($newManager);
        }

        return $this;
    }

    /**
     * @return Collection|ClubManager[]
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(ClubManager $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
            $club->setManager($this);
        }

        return $this;
    }

    public function removeClub(ClubManager $club): self
    {
        if ($this->clubs->contains($club)) {
            $this->clubs->removeElement($club);
            // set the owning side to null (unless already changed)
            if ($club->getManager() === $this) {
                $club->setManager(null);
            }
        }

        return $this;
    }

}
