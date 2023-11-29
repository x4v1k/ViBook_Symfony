<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Libros
 *
 * @ORM\Table(name="libros", indexes={@ORM\Index(name="ID_Grupo_Etiqueta", columns={"ID_Grupo_Etiqueta"})})
 * @ORM\Entity
 */
class Libros
{
    /**
     * @var int
     *
     * @ORM\Column(name="isbn", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $isbn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="autor", type="string", length=255, nullable=true)
     */
    private $autor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precio;

    /**
     * @var \GruposEtiquetas
     *
     * @ORM\ManyToOne(targetEntity="GruposEtiquetas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Grupo_Etiqueta", referencedColumnName="ID_Grupo_Etiqueta")
     * })
     */
    private $idGrupoEtiqueta;

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): static
    {
        $this->autor = $autor;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    // public function getIdGrupoEtiqueta(): ?GruposEtiquetas
    // {
    //     return $this->idGrupoEtiqueta;
    // }

    public function setIdGrupoEtiqueta(?GruposEtiquetas $idGrupoEtiqueta): static
    {
        $this->idGrupoEtiqueta = $idGrupoEtiqueta;

        return $this;
    }


}
