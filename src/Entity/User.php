<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProposedReferendumStudent", mappedBy="ProposalReferendum")
     */
    private $y;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProposedReferendumStudent", mappedBy="ProposedReferendum")
     */
    private $proposedReferendumStudents;

    public function __construct()
    {
        $this->y = new ArrayCollection();
        $this->proposedReferendumStudents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles()
    {
        $userRole = $this->role;
        $roles = array( $userRole );
        if($userRole == "ROLE_ADMIN"){ array_push($roles,'ROLE_STUDENT'); }
        return $roles;
    }

    public function getSalt() {}

    public function eraseCredentials() {}

    /**
     * @return Collection|ProposedReferendumStudent[]
     */
    public function getY(): Collection
    {
        return $this->y;
    }

    public function addY(ProposedReferendumStudent $y): self
    {
        if (!$this->y->contains($y)) {
            $this->y[] = $y;
            $y->addProposalReferendum($this);
        }

        return $this;
    }

    public function removeY(ProposedReferendumStudent $y): self
    {
        if ($this->y->contains($y)) {
            $this->y->removeElement($y);
            $y->removeProposalReferendum($this);
        }

        return $this;
    }

    /**
     * @return Collection|ProposedReferendumStudent[]
     */
    public function getProposedReferendumStudents(): Collection
    {
        return $this->proposedReferendumStudents;
    }

    public function addProposedReferendumStudent(ProposedReferendumStudent $proposedReferendumStudent): self
    {
        if (!$this->proposedReferendumStudents->contains($proposedReferendumStudent)) {
            $this->proposedReferendumStudents[] = $proposedReferendumStudent;
            $proposedReferendumStudent->addProposedReferendum($this);
        }

        return $this;
    }

    public function removeProposedReferendumStudent(ProposedReferendumStudent $proposedReferendumStudent): self
    {
        if ($this->proposedReferendumStudents->contains($proposedReferendumStudent)) {
            $this->proposedReferendumStudents->removeElement($proposedReferendumStudent);
            $proposedReferendumStudent->removeProposedReferendum($this);
        }

        return $this;
    }


}