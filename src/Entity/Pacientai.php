<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PacientaiRepository")
 */
class Pacientai
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
    private $gydymas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nusiskundimai;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alergijos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bendrinesLigos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amzius;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $pirmadienis = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $antradienis = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $treciadienis = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $ketvirtadienis = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $penktadienis = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $betKada = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vardas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeris;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pacientai")
     */
    private $atsakingas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eile", mappedBy="pacientas")
     */
    private $eiles;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $test = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $regData;

    /**
     * @ORM\Column(type="array")
     */
    private $kalbos = [];

    public function __construct()
    {
        $this->eiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGydymas(): ?string
    {
        return $this->gydymas;
    }

    public function setGydymas(?string $gydymas): self
    {
        $this->gydymas = $gydymas;

        return $this;
    }

    public function getNusiskundimai(): ?string
    {
        return $this->nusiskundimai;
    }

    public function setNusiskundimai(?string $nusiskundimai): self
    {
        $this->nusiskundimai = $nusiskundimai;

        return $this;
    }

    public function getAlergijos(): ?string
    {
        return $this->alergijos;
    }

    public function setAlergijos(?string $alergijos): self
    {
        $this->alergijos = $alergijos;

        return $this;
    }

    public function getBendrinesLigos(): ?string
    {
        return $this->bendrinesLigos;
    }

    public function setBendrinesLigos(?string $bendrinesLigos): self
    {
        $this->bendrinesLigos = $bendrinesLigos;

        return $this;
    }

    public function getAmzius(): ?string
    {
        return $this->amzius;
    }

    public function setAmzius(string $amzius): self
    {
        $this->amzius = $amzius;

        return $this;
    }

    public function getPirmadienis(): ?array
    {
        return $this->pirmadienis;
    }

    public function setPirmadienis(?array $pirmadienis): self
    {
        $this->pirmadienis = $pirmadienis;

        return $this;
    }

    public function getAntradienis(): ?array
    {
        return $this->antradienis;
    }

    public function setAntradienis(?array $antradienis): self
    {
        $this->antradienis = $antradienis;

        return $this;
    }

    public function getTreciadienis(): ?array
    {
        return $this->treciadienis;
    }

    public function setTreciadienis(?array $treciadienis): self
    {
        $this->treciadienis = $treciadienis;

        return $this;
    }

    public function getKetvirtadienis(): ?array
    {
        return $this->ketvirtadienis;
    }

    public function setKetvirtadienis(?array $ketvirtadienis): self
    {
        $this->ketvirtadienis = $ketvirtadienis;

        return $this;
    }

    public function getPenktadienis(): ?array
    {
        return $this->penktadienis;
    }

    public function setPenktadienis(?array $penktadienis): self
    {
        $this->penktadienis = $penktadienis;

        return $this;
    }

    public function getBetKada(): ?array
    {
        return $this->betKada;
    }

    public function setBetKada(?array $betKada): self
    {
        $this->betKada = $betKada;

        return $this;
    }

    public function getTest(): ?array
    {
        return $this->test;
    }

    public function setTest(?array $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getVardas(): ?string
    {
        return $this->vardas;
    }

    public function setVardas(string $vardas): self
    {
        $this->vardas = $vardas;

        return $this;
    }

    public function getNumeris(): ?string
    {
        return $this->numeris;
    }

    public function setNumeris(string $numeris): self
    {
        $this->numeris = $numeris;

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

    /**
     * @return Collection|Eile[]
     */
    public function getEiles(): Collection
    {
        return $this->eiles;
    }

    public function addEile(Eile $eile): self
    {
        if (!$this->eiles->contains($eile)) {
            $this->eiles[] = $eile;
            $eile->setPacientas($this);
        }

        return $this;
    }

    public function removeEile(Eile $eile): self
    {
        if ($this->eiles->contains($eile)) {
            $this->eiles->removeElement($eile);
            // set the owning side to null (unless already changed)
            if ($eile->getPacientas() === $this) {
                $eile->setPacientas(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRegData(): ?\DateTimeInterface
    {
        return $this->regData;
    }

    public function setRegData(?\DateTimeInterface $regData): self
    {
        $this->regData = $regData;

        return $this;
    }

    public function getKalbos(): ?array
    {
        return $this->kalbos;
    }

    public function setKalbos(array $kalbos): self
    {
        $this->kalbos = $kalbos;

        return $this;
    }


}
