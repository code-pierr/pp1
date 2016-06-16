<?php

namespace Libro\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Libro\MainBundle\Entity\Area;
/**
 * Documento
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Libro\MainBundle\Entity\DocumentoRepository")
 */
class Documento
{

    /**
    *@ORM\ManyToOne(targetEntity="Expediente", inversedBy="documento")
    *@ORM\JoinColumn(name="Expediente_id", referencedColumnName="id")
    */
    private $expediente;
    /**
    *@ORM\ManyToOne(targetEntity="Area", inversedBy="documento")
    *@ORM\JoinColumn(name="Area_id", referencedColumnName="id")
    */
    private $area;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string", length=45)
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
     * @ORM\Column(name="de", type="string", length=45)
     */
    private $de;

    /**
     * @var string
     *
     * @ORM\Column(name="para", type="string", length=45)
     */
    private $para;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoDoc", type="string", length=45)
     */
    private $tipoDoc;

    /**
     * Set id
     *
     * @param string $id
     * @return Documento
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
     * @return Documento
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
     * Set de
     *
     * @param string $de
     * @return Documento
     */
    public function setDe($de)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return string
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set para
     *
     * @param string $para
     * @return Documento
     */
    public function setPara($para)
    {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return string
     */
    public function getPara()
    {
        return $this->para;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Documento
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Documento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipoDoc
     *
     * @param string $tipoDoc
     * @return Documento
     */
    public function setTipoDoc($tipoDoc)
    {
        $this->tipoDoc = $tipoDoc;

        return $this;
    }

    /**
     * Get tipoDoc
     *
     * @return string
     */
    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }

    public function setArea($area)
    {
      $this->area = $area;
    }

    public function getArea()
    {
      return $this->area;
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
