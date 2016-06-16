<?php

namespace Libro\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Libro
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Libro\MainBundle\Entity\LibroRepository")
 */
class Libro
{


    /**
    *@ORM\OneToOne(targetEntity="Expediente")
    *@ORM\JoinColumn(name="Expediente_id", referencedColumnName="id")
    */
    private $expediente;

     /**
      *@ORM\ManyToOne(targetEntity="Usuario", inversedBy="libro")
      *@ORM\JoinColumn(name="Usuario_id", referencedColumnName="id")
      */

      private $usuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="text")
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=20)
     */
    private $estado;

    public function __toString()
    {
      return $this->expediente;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Libro
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Libro
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Documento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    //de Usuario

    public function setUsuario($usuario)
    {
      $this->usuario = $usuario;
    }

    public function getUsuario()
    {
      return $this->usuario;
    }

    public function setExpediente($expediente)
    {
      $this->expediente = $expediente;
    }

    public function getExpediente()
    {
      return $this->expediente;
    }
}
