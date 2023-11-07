<?php

// namespace App\Entity;

// use App\Repository\ApplyEditRepository;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\DBAL\Types\Types;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: ApplyEditRepository::class)]
// class ApplyEdit
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(length: 255)]
//     private ?string $fullName = null;

//     #[ORM\Column]
//     private ?int $phoneNumber = null;

    // #[ORM\Column(length: 255)]
    // private ?string $email = null;

    // #[ORM\Column(length: 255)]
    // private ?string $cv = null;

    // #[ORM\Column(length: 255)]
    // private ?string $coverLetter = null;

    // #[ORM\Column(type: Types::TEXT)]
    // private ?string $skills = null;

    // #[ORM\ManyToMany(targetEntity: Annonce::class, mappedBy: 'Apply')]
    // private Collection $annonces;

    // public function __construct()
    // {
    //     $this->annonces = new ArrayCollection();
    // }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // public function getFullName(): ?string
    // {
    //     return $this->fullName;
    // }

    // public function setFullName(string $fullName): self
    // {
    //     $this->fullName = $fullName;

    //     return $this;
    // }

    // public function getPhoneNumber(): ?int
    // {
    //     return $this->phoneNumber;
    // }

    // public function setPhoneNumber(int $phoneNumber): self
    // {
    //     $this->phoneNumber = $phoneNumber;

    //     return $this;
    // }

//     public function getEmail(): ?string
//     {
//         return $this->email;
//     }

//     public function setEmail(string $email): self
//     {
//         $this->email = $email;

//         return $this;
//     }

//     public function getCv(): ?string
//     {
//         return $this->cv;
//     }

//     public function setCv(string $cv): self
//     {
//         $this->cv = $cv;

//         return $this;
//     }

//     public function getCoverLetter(): ?string
//     {
//         return $this->coverLetter;
//     }

//     public function setCoverLetter(string $coverLetter): self
//     {
//         $this->coverLetter = $coverLetter;

//         return $this;
//     }

//     public function getSkills(): ?string
//     {
//         return $this->skills;
//     }

//     public function setSkills(string $skills): self
//     {
//         $this->skills = $skills;

//         return $this;
//     }

//     /**
//      * @return Collection<int, Annonce>
//      */
//     public function getAnnonces(): Collection
//     {
//         return $this->annonces;
//     }

//     public function addAnnonce(Annonce $annonce): self
//     {
//         if (!$this->annonces->contains($annonce)) {
//             $this->annonces->add($annonce);
//             $annonce->addApply($this);
//         }

//         return $this;
//     }

//     public function removeAnnonce(Annonce $annonce): self
//     {
//         if ($this->annonces->removeElement($annonce)) {
//             $annonce->removeApply($this);
//         }

//         return $this;
//     }
// }
