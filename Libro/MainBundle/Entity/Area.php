<?php

namespace Libro\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Libro\MainBundle\Entity\AreaRepository")
 */
class Area
{
    /**
      *
      * @ORM\OneToMany(targetEntity="Documento", mappedBy="area")
      *
      */
      private $documento;
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="encargado", type="string", length=255)
     */
    private $encargado;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer")
     */
    private $telefono;

    public function __construct() {
      $this->documento = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Area
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
     * Set nombre
     *
     * @param string $nombre
     * @return Area
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set encargado
     *
     * @param string $encargado
     * @return Area
     */
    public function setEncargado($encargado)
    {
        $this->encargado = $encargado;

        return $this;
    }

    /**
     * Get encargado
     *
     * @return string
     */
    public function getEncargado()
    {
        return $this->encargado;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Area
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function  addDocumento($documento)
    {
      $this->documento[] = $documento;
    }
    public function getDocumento()
    {
      return $this->documento;
    }

}
