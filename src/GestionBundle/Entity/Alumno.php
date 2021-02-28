<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="gestion_alumnos")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\AlumnoRepository")
 */
class Alumno extends Ente
{

    /**
     * @var string
     *
     * @ORM\Column(name="legajo", type="string", length=255, nullable=true)
     */
    private $legajo;




    /**
     * Set legajo
     *
     * @param string $legajo
     *
     * @return Alumno
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * Get legajo
     *
     * @return string
     */
    public function getLegajo()
    {
        return $this->legajo;
    }
}
