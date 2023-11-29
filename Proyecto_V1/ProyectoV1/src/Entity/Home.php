<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Home
 *
 * @ORM\Table(name="home")
 * @ORM\Entity
 */
class Home
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Apartado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idApartado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Apartado", type="string", length=255, nullable=true)
     */
    private $apartado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Contenido", type="text", length=65535, nullable=true)
     */
    private $contenido;

    public function getIdApartado(): ?int
    {
        return $this->idApartado;
    }

    public function getApartado(): ?string
    {
        return $this->apartado;
    }

    public function setApartado(?string $apartado): static
    {
        $this->apartado = $apartado;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(?string $contenido): static
    {
        $this->contenido = $contenido;

        return $this;
    }


}
