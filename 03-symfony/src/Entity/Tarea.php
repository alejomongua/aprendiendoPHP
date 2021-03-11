<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TareaRepository::class)
 * @ORM\Table(name="`tarea`")
 * @ORM\HasLifecycleCallbacks
 */
class Tarea
{
    const ESTADOS = [
        'Creada' => 'Creada',
        'En proceso' => 'En proceso',
        'En pausa' => 'En pausa',
        'Finalizada' => 'Finalizada',
        'Abortada' => 'Abortada',
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

    /**
     * @ORM\ManyToMany(targetEntity=Etiqueta::class, inversedBy="tareas")
     */
    private $etiquetas;

    public function __construct()
    {
        $this->hijas = new ArrayCollection();
        $this->etiquetas = new ArrayCollection();
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

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime("now");
    }

    public function __toString()
    {
        return $this->titulo;
    }

    /**
     * @return Collection|Etiqueta[]
     */
    public function getEtiquetas(): Collection
    {
        return $this->etiquetas;
    }

    public function addEtiqueta(Etiqueta $etiqueta): self
    {
        if (!$this->etiquetas->contains($etiqueta)) {
            $this->etiquetas[] = $etiqueta;
        }

        return $this;
    }

    public function removeEtiqueta(Etiqueta $etiqueta): self
    {
        $this->etiquetas->removeElement($etiqueta);

        return $this;
    }

    public function nombresEtiquetas(): string {
        $arrayEtiquetas = array_map(function (Etiqueta $etiqueta) {
            return $etiqueta->getNombre();
        }, $this->etiquetas->toArray());

        return json_encode($arrayEtiquetas);
    }

    public function activa()
    {
        $estado = $this->getEstado();
        return $estado == 'Creada' || $estado == 'En proceso' || $estado == 'En pausa';
    }

    public function vencida() {
        if (!$this->activa()) {
            return false;
        }

        $finDelDia = new \DateTime();
        $finDelDia->setTime(23, 59, 59);
        return $this->fin < $finDelDia;
    }

    public function paraHoy() {
        if (!$this->activa()) {
            return false;
        }

        $hoy = new \DateTime();
        if ($this->inicio > $hoy) {
            return false;
        }

        $hoy->setTime(23, 59, 59);
        return $this->fin > $hoy;
    }

}
