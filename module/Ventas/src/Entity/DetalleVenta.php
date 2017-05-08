<?php
namespace Ventas\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="DetalleVenta")
 */
class DetalleVenta
{
 /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(name="ID")   
   */
  protected $id;
  /** 
   * @ORM\Column(name="VentaID")  
   */
  protected $ventaId;
  /** 
   * @ORM\Column(name="ProductosID")  
   */
  protected $productosId;
  /** 
   * @ORM\Column(name="Cantidad")  
   */
  protected $cantidad;
  /** 
   * @ORM\Column(name="Reserva")  
   */
  protected $reserva;
  /** 
   * @ORM\Column(name="Fecha")  
   */
  protected $fecha;
  
  public function getId() 
  {
    return $this->id;
  }
  
  public function setId($id) 
  {
    $this->id = $id;
  }
  
  public function getVentaId() 
  {
    return $this->ventaId;
  }
  
  public function setVentaId($ventaId) 
  {
    $this->ventaId = $ventaId;
  }
  
  public function getProductosId() 
  {
    return $this->productosId;
  }
  
  public function setProductosId($productosId) 
  {
    $this->productosId = $productosId;
  }
  
  public function getCantidad() 
  {
    return $this->cantidad;
  }
  
  public function setCantidad($cantidad) 
  {
    $this->cantidad = $cantidad;
  }
  
  public function getReserva() 
  {
    return $this->reserva;
  }
  
  public function setReserva($reserva) 
  {
    $this->reserva = $reserva;
  }
  
  public function getFecha() 
  {
    return $this->fecha;
  }
  
  public function setFecha($fecha) 
  {
    $this->fecha = $fecha;
  }   
  
}