<?php
namespace Ventas\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Ventas")
 */
class Ventas
{
 /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(name="ID")   
   */
  protected $id;
  /** 
   * @ORM\Column(name="OrdenCompra")  
   */
  protected $ordenCompra;
  /** 
   * @ORM\Column(name="FechaCreacion")  
   */
  protected $fechaCreacion;
  /** 
   * @ORM\Column(name="FechaCompra")  
   */
  protected $fechaCompra;
  /** 
   * @ORM\Column(name="FechaEntrega")  
   */
  protected $fechaEntrega;
  /** 
   * @ORM\Column(name="UsuarioID")  
   */
  protected $usuarioID;
  /** 
   * @ORM\Column(name="DocumentoID")  
   */
  protected $documentoID;
  
  public function getId() 
  {
    return $this->id;
  }
  
  public function setId($id) 
  {
    $this->id = $id;
  }
  
  public function getOrdenCompra() 
  {
    return $this->ordenCompra;
  }
  
  public function setOrdenCompra($ordenCompra) 
  {
    $this->ordenCompra = $ordenCompra;
  }
  
  public function getFechaCreacion() 
  {
    return $this->fechaCreacion;
  }
  
  public function setFechaCreacion($fechaCreacion) 
  {
    $this->fechaCreacion = $fechaCreacion;
  }
  
  public function getFechaCompra() 
  {
    return $this->fechaCompra;
  }
  
  public function setFechaCompra($fechaCompra) 
  {
    $this->fechaCompra = $fechaCompra;
  }
  
  public function getFechaEntrega() 
  {
    return $this->fechaEntrega;
  }
  
  public function setFechaEntrega($fechaEntrega) 
  {
    $this->fechaEntrega = $fechaEntrega;
  }
  
  public function getUsuarioID() 
  {
    return $this->usuarioID;
  }
  
  public function setUsuarioID($usuarioID) 
  {
    $this->usuarioID = $usuarioID;
  }
  
  public function getDocumentoID() 
  {
    return $this->documentoID;
  }
  
  public function setDocumentoID($documentoID) 
  {
    $this->documentoID = $documentoID;
  }
}


