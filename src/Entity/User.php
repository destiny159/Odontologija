<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     *
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lsp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kursas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $miestas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kalba;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Klinikiniai", mappedBy="atsakingas")
     */
    private $Klinikiniai;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pacientai", mappedBy="atsakingas")
     */
    private $pacientai;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eile", mappedBy="user")
     */
    private $eiles;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $yraNauju;

    public function __construct()
    {
        $this->Klinikiniai = new ArrayCollection();
        $this->pacientai = new ArrayCollection();
        $this->eiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getLsp(): ?string
    {
        return $this->lsp;
    }

    public function setLsp(string $lsp): self
    {
        $this->lsp = $lsp;

        return $this;
    }

    public function getKursas(): ?string
    {
        return $this->kursas;
    }

    public function setKursas(string $kursas): self
    {
        $this->kursas = $kursas;

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

    public function getKalba(): ?string
    {
        return $this->kalba;
    }

    public function setKalba(string $kalba): self
    {
        $this->kalba = $kalba;

        return $this;
    }

    /**
     * @return Collection|Klinikiniai[]
     */
    public function getKlinikiniai(): Collection
    {
        return $this->Klinikiniai;
    }

    public function addKlinikiniai(Klinikiniai $klinikiniai): self
    {
        if (!$this->Klinikiniai->contains($klinikiniai)) {
            $this->Klinikiniai[] = $klinikiniai;
            $klinikiniai->setAtsakingas($this);
        }

        return $this;
    }

    public function removeKlinikiniai(Klinikiniai $klinikiniai): self
    {
        if ($this->Klinikiniai->contains($klinikiniai)) {
            $this->Klinikiniai->removeElement($klinikiniai);
            // set the owning side to null (unless already changed)
            if ($klinikiniai->getAtsakingas() === $this) {
                $klinikiniai->setAtsakingas(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) ($this->fullName);
    }

    /**
     * @return Collection|Pacientai[]
     */
    public function getPacientai(): Collection
    {
        return $this->pacientai;
    }

    public function addPacientai(Pacientai $pacientai): self
    {
        if (!$this->pacientai->contains($pacientai)) {
            $this->pacientai[] = $pacientai;
            $pacientai->setAtsakingas($this);
        }

        return $this;
    }

    public function removePacientai(Pacientai $pacientai): self
    {
        if ($this->pacientai->contains($pacientai)) {
            $this->pacientai->removeElement($pacientai);
            // set the owning side to null (unless already changed)
            if ($pacientai->getAtsakingas() === $this) {
                $pacientai->setAtsakingas(null);
            }
        }

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
            $eile->setUser($this);
        }

        return $this;
    }

    public function removeEile(Eile $eile): self
    {
        if ($this->eiles->contains($eile)) {
            $this->eiles->removeElement($eile);
            // set the owning side to null (unless already changed)
            if ($eile->getUser() === $this) {
                $eile->setUser(null);
            }
        }

        return $this;
    }

    public function getYraNauju(): ?bool
    {
        return $this->yraNauju;
    }

    public function setYraNauju(?bool $yraNauju): self
    {
        $this->yraNauju = $yraNauju;

        return $this;
    }
}
