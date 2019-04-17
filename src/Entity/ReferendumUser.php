<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReferendumUserRepository")
 */
class ReferendumUser
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
    private $Referendum;

    /**
     * @ORM\Column(type="integer")
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferendum(): ?int
    {
        return $this->Referendum;
    }

    public function setReferendum(int $Referendum): self
    {
        $this->Referendum = $Referendum;

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
