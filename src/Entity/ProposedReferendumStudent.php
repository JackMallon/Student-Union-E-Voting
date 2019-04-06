<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProposedReferendumStudentRepository")
 */
class ProposedReferendumStudent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="proposedReferendumStudents")
     */
    private $ProposedReferendum;

    public function __construct()
    {
        $this->ProposedReferendum = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getProposedReferendum(): Collection
    {
        return $this->ProposedReferendum;
    }

    public function addProposedReferendum(User $proposedReferendum): self
    {
        if (!$this->ProposedReferendum->contains($proposedReferendum)) {
            $this->ProposedReferendum[] = $proposedReferendum;
        }

        return $this;
    }

    public function removeProposedReferendum(User $proposedReferendum): self
    {
        if ($this->ProposedReferendum->contains($proposedReferendum)) {
            $this->ProposedReferendum->removeElement($proposedReferendum);
        }

        return $this;
    }
}
