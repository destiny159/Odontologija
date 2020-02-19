<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AtsiliepimaiRepository")
 */
class Atsiliepimai
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vardas;

    /**
     * @ORM\Column(type="text")
     */
    private $atsiliepimas;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVardas(): ?string
    {
        return $this->vardas;
    }

    public function setVardas(?string $vardas): self
    {
        $this->vardas = $vardas;

        return $this;
    }

    public function getAtsiliepimas(): ?string
    {
        return $this->atsiliepimas;
    }

    public function setAtsiliepimas(string $atsiliepimas): self
    {
        $this->atsiliepimas = $atsiliepimas;

        return $this;
    }

}
