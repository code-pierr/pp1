<?php

namespace Libro\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Expediente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Libro\MainBundle\Entity\ExpedienteRepository")
 */
class Expediente
{

    /**
    *@ORM\OneToMany(targetEntity="Documento", mappedBy="expediente")
    *
    */
    private $documento;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
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
     * @ORM\Column(name="tipo", type="string", length=45)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="blob")
     */
    private $contenido;

    /**
     * Set id
     *
     * @param integer $id
     * @return Expediente
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Expediente
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
     * Set tipo
     *
     * @param string $tipo
     * @return Expediente
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Expediente
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
     * Set contenido
     *
     * @param string $contenido
     * @return Expediente
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    // gertters y setters de la tabla  documento

    public function __construct()
    {
      $this->documento = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function adddocumento(\Libro\MainBundle\Entity\Documento $documento)
    {
      $this->documento[] = $documento;
    }
    public function getdocumento()
    {
      return $this->documento;
    }

    public function setLibro(\Libro\MainBundle\Entity\Libro $libro)
    {
      $this->libro = $libro;
    }

    public function getLibro()
    {
      return $this->libro = $libro;
    }

}
