<?php

namespace App\Entity;

use App\Repository\ProyectoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProyectoRepository::class)
 * @ORM\Table(name="`proyecto`")
 * @ORM\HasLifecycleCallbacks
 */
class Proyecto
{
    const ESTADOS = [
        'Creado' => 'Creado',
        'En proceso' => 'En proceso',
        'En pausa' => 'En pausa',
        'Cerrado' => 'Cerrado',
        'Abortado' => 'Abortado',
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $inicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="proyectos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generado_por;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var datetime $updated
     * 
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $updated;

    /**
     * @ORM\OneToMany(targetEntity=Tarea::class, mappedBy="proyecto", orphanRemoval=true)
     */
    private $tareas;

    /**
     * @ORM\ManyToMany(targetEntity=Etiqueta::class, inversedBy="proyectos")
     */
    private $etiquetas;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="proyectosAutorizados")
     */
    private $autorizados;

    public function __construct()
    {
        $this->tareas = new ArrayCollection();
        $this->etiquetas = new ArrayCollection();
        $this->autorizados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        $fin->setTime(23, 59, 59);
        $this->fin = $fin;

        return $this;
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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

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

    public function getGeneradoPor(): ?User
    {
        return $this->generado_por;
    }

    public function setGeneradoPor(?User $generado_por): self
    {
        $this->generado_por = $generado_por;

        return $this;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function getUpdated(): ?\DateTime
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

    /**
     * @return Collection|Tarea[]
     */
    public function getTareas(): Collection
    {
        return $this->tareas;
    }

    /**
     * @return Collection|Tarea[]
     */
    public function getTareasVencidas(): Collection
    {
        return $this->tareas->filter(function(Tarea $tarea) {
            return $tarea->vencida();
        });
    }

    /**
     * @return Collection|Tarea[]
     */
    public function getTareasParaHoy(): Collection
    {
        return $this->tareas->filter(function(Tarea $tarea) {
            return $tarea->paraHoy();
        });
    }

    public function addTarea(Tarea $tarea): self
    {
        if (!$this->tareas->contains($tarea)) {
            $this->tareas[] = $tarea;
            $tarea->setProyecto($this);
        }

        return $this;
    }

    public function removeTarea(Tarea $tarea): self
    {
        if ($this->tareas->removeElement($tarea)) {
            // set the owning side to null (unless already changed)
            if ($tarea->getProyecto() === $this) {
                $tarea->setProyecto(null);
            }
        }

        return $this;
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

    public function nombresEtiquetasArray(): array {
        return array_map(function (Etiqueta $etiqueta) {
            return $etiqueta->getNombre();
        }, $this->etiquetas->toArray());
    }

    public function nombresEtiquetas(): string {
        return json_encode($this->nombresEtiquetasArray());
    }

    /**
     * @return Collection|User[]
     */
    public function getAutorizados(): Collection
    {
        return $this->autorizados;
    }

    public function addAutorizado(User $autorizado): self
    {
        if (!$this->autorizados->contains($autorizado)) {
            $this->autorizados[] = $autorizado;
        }

        return $this;
    }

    public function removeAutorizado(User $autorizado): self
    {
        $this->autorizados->removeElement($autorizado);

        return $this;
    }
}
