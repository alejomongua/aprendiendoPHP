<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TareaRepository::class)
 */
class Tarea
{
    const ESTADOS = [
        'Creado' => 'Creado',
        'En proceso' => 'En proceso',
        'En pausa' => 'En pausa',
        'Cerrado' => 'Cerrado',
        'Abortado' => 'Abortado',
    ];

    const TIPOS = [
        'Genérica' => 'Genérica',
        'Aprender' => 'Aprender',
        'Hacer' => 'Hacer',
        'Recordar' => 'Recordar',
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $inicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $estado;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $progreso;

    /**
     * @ORM\ManyToOne(targetEntity=Proyecto::class, inversedBy="tareas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proyecto;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tareas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generado_por;

    /**
     * @ORM\ManyToOne(targetEntity=Tarea::class, inversedBy="hijas")
     */
    private $padre;

    /**
     * @ORM\OneToMany(targetEntity=Tarea::class, mappedBy="padre")
     */
    private $hijas;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    public function __construct()
    {
        $this->hijas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getInicio(): ?\DateTimeInterface
    {
        return $this->inicio;
    }

    public function setInicio(?\DateTimeInterface $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(?\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getProgreso(): ?int
    {
        return $this->progreso;
    }

    public function setProgreso(?int $progreso): self
    {
        $this->progreso = $progreso;

        return $this;
    }

    public function getProyecto(): ?Proyecto
    {
        return $this->proyecto;
    }

    public function setProyecto(?Proyecto $proyecto): self
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    public function getGeneradoPor(): ?User
    {
        return $this->generado_por;
    }

    public function setGeneradoPor(?User $generado_por): self
    {
        $this->generado_por = $generado_por;

        return $this;
    }

    public function getPadre(): ?self
    {
        return $this->padre;
    }

    public function setPadre(?self $padre): self
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getHijas(): Collection
    {
        return $this->hijas;
    }

    public function addHija(self $hija): self
    {
        if (!$this->hijas->contains($hija)) {
            $this->hijas[] = $hija;
            $hija->setPadre($this);
        }

        return $this;
    }

    public function removeHija(self $hija): self
    {
        if ($this->hijas->removeElement($hija)) {
            // set the owning side to null (unless already changed)
            if ($hija->getPadre() === $this) {
                $hija->setPadre(null);
            }
        }

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function toString()
    {
        return $this->titulo;
    }

}
