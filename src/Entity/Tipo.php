<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoRepository::class)]
class Tipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: Motos::class, mappedBy: 'tipos')]
    private Collection $motos;

    #[ORM\ManyToMany(targetEntity: Moto::class, mappedBy: 'Tipos')]
    private Collection $moto;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
        $this->moto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Motos>
     */
    public function getMotos(): Collection
    {
        return $this->motos;
    }

    public function addMoto(Motos $moto): self
    {
        if (!$this->motos->contains($moto)) {
            $this->motos->add($moto);
            $moto->addTipo($this);
        }

        return $this;
    }

    public function removeMoto(Motos $moto): self
    {
        if ($this->motos->removeElement($moto)) {
            $moto->removeTipo($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Moto>
     */
    public function getMoto(): Collection
    {
        return $this->moto;
    }
}
