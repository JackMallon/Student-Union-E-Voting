<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProposedReferendumUserRepository")
 */
class ProposedReferendumUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProposedReferendum;

    /**
     * @ORM\Column(type="integer")
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProposedReferendum(): ?int
    {
        return $this->ProposedReferendum;
    }

    public function setProposedReferendum(int $ProposedReferendum): self
    {
        $this->ProposedReferendum = $ProposedReferendum;

        return $this;
    }

    public function getUser(): ?int
    {
        return $this->User;
    }

    public function setUser(int $User): self
    {
        $this->User = $User;

        return $this;
    }
}
