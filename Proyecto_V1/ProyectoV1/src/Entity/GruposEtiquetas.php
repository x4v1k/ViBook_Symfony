<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GruposEtiquetas
 *
 * @ORM\Table(name="grupos_etiquetas")
 * @ORM\Entity
 */
class GruposEtiquetas
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Grupo_Etiqueta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupoEtiqueta;

    public function getIdGrupoEtiqueta(): ?int
    {
        return $this->idGrupoEtiqueta;
    }


}
