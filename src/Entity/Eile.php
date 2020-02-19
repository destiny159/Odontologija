<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EileRepository")
 */
class Eile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pacientai", inversedBy="eiles")
     */
    private $pacientas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="eiles")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPacientas(): ?Pacientai
    {
        return $this->pacientas;
    }

    public function setPacientas(?Pacientai $pacientas): self
    {
        $this->pacientas = $pacientas;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }
}
