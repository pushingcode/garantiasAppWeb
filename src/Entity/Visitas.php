<?php

namespace App\Entity;

use App\Repository\VisitasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitasRepository::class)
 */
class Visitas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $tecnico;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $numero_orden;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $t_orden;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $st_orden;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $numero_cuenta;

    /**
     * @ORM\Column(type="text")
     */
    private $n_entrante;

    /**
     * @ORM\Column(type="text")
     */
    private $n_cierre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTecnico(): ?string
    {
        return $this->tecnico;
    }

    public function setTecnico(string $tecnico): self
    {
        $this->tecnico = $tecnico;

        return $this;
    }

    public function getNumeroOrden(): ?string
    {
        return $this->numero_orden;
    }

    public function setNumeroOrden(string $numero_orden): self
    {
        $this->numero_orden = $numero_orden;

        return $this;
    }

    public function getTOrden(): ?string
    {
        return $this->t_orden;
    }

    public function setTOrden(string $t_orden): self
    {
        $this->t_orden = $t_orden;

        return $this;
    }

    public function getStOrden(): ?string
    {
        return $this->st_orden;
    }

    public function setStOrden(string $st_orden): self
    {
        $this->st_orden = $st_orden;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    public function getNumeroCuenta(): ?string
    {
        return $this->numero_cuenta;
    }

    public function setNumeroCuenta(string $numero_cuenta): self
    {
        $this->numero_cuenta = $numero_cuenta;

        return $this;
    }

    public function getNEntrante(): ?string
    {
        return $this->n_entrante;
    }

    public function setNEntrante(string $n_entrante): self
    {
        $this->n_entrante = $n_entrante;

        return $this;
    }

    public function getNCierre(): ?string
    {
        return $this->n_cierre;
    }

    public function setNCierre(string $n_cierre): self
    {
        $this->n_cierre = $n_cierre;

        return $this;
    }
}
