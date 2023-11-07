<?php

namespace App\Entity;

use App\Repository\AnnonceEditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceEditRepository::class)]
class AnnonceEdit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $backgroundImage = null;

    #[ORM\Column(length: 255)]
    private ?string $profileImage = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $overview = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Category $Category = null;

    #[ORM\Column(length: 255)]
    private ?string $experience = null;

    #[ORM\Column(length: 255)]
    private ?string $workLevel = null;

    #[ORM\Column]
    private ?float $salary = null;

    #[ORM\ManyToMany(targetEntity: Apply::class, inversedBy: 'annonces')]
    private Collection $Apply;

    public function __construct()
    {
        $this->Apply = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(string $backgroundImage): self
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profileImage;
    }

    public function setProfileImage(string $profileImage): self
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): self
    {
        $this->overview = $overview;

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

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getWorkLevel(): ?string
    {
        return $this->workLevel;
    }

    public function setWorkLevel(string $workLevel): self
    {
        $this->workLevel = $workLevel;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return Collection<int, Apply>
     */
    public function getApply(): Collection
    {
        return $this->Apply;
    }

    public function addApply(Apply $apply): self
    {
        if (!$this->Apply->contains($apply)) {
            $this->Apply->add($apply);
        }

        return $this;
    }

    public function removeApply(Apply $apply): self
    {
        $this->Apply->removeElement($apply);

        return $this;
    }
}
