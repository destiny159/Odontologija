<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KlinikiniaiRepository")
 */
class Klinikiniai
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
    private $pavadinimas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aprasymas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kontaktai;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Klinikiniai")
     */
    private $atsakingas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $miestas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->pavadinimas;
    }

    public function setPavadinimas(string $pavadinimas): self
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    public function getAprasymas(): ?string
    {
        return $this->aprasymas;
    }

    public function setAprasymas(?string $aprasymas): self
    {
        $this->aprasymas = $aprasymas;

        return $this;
    }

    public function getKontaktai(): ?string
    {
        return $this->kontaktai;
    }

    public function setKontaktai(string $kontaktai): self
    {
        $this->kontaktai = $kontaktai;

        return $this;
    }

    public function getAtsakingas(): ?User
    {
        return $this->atsakingas;
    }

    public function setAtsakingas(?User $atsakingas): self
    {
        $this->atsakingas = $atsakingas;

        return $this;
    }

    public function getMiestas(): ?string
    {
        return $this->miestas;
    }

    public function setMiestas(string $miestas): self
    {
        $this->miestas = $miestas;

        return $this;
    }
}
