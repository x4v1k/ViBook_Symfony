<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiquetas
 *
 * @ORM\Table(name="etiquetas", indexes={@ORM\Index(name="ID_Grupo_Etiqueta", columns={"ID_Grupo_Etiqueta"})})
 * @ORM\Entity
 */
class Etiquetas
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Etiquetas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtiquetas;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \GruposEtiquetas
     *
     * @ORM\ManyToOne(targetEntity="GruposEtiquetas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Grupo_Etiqueta", referencedColumnName="ID_Grupo_Etiqueta")
     * })
     */
    private $idGrupoEtiqueta;

    public function getIdEtiquetas(): ?int
    {
        return $this->idEtiquetas;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

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
