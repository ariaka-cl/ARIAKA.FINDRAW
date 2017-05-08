<?php
namespace Ventas\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Productos")
 */
class Productos 
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(name="ID")   
   */
  protected $id;

  /** 
   * @ORM\Column(name="Codigo")  
   */
  protected $codigo;

  /** 
   * @ORM\Column(name="Nombre")  
   */
  protected $nombre;

  /** 
   * @ORM\Column(name="Descripcion")  
   */
  protected $descripcion;

  /**
   * @ORM\Column(name="Precio")  
   */
  protected $precio; 

  /**
   * @ORM\Column(name="Stock")  
   */
  protected $stock;   

   public function getId() 
  {
    return $this->id;
  }

  // Sets ID of this post.
  public function setId($id) 
  {
    $this->id = $id;
  }

   public function getCodigo() 
  {
    return $this->codigo;
  }

  // Sets ID of this post.
  public function setCodigo($codigo) 
  {
    $this->codigo = $codigo;
  }

   public function getNombre() 
  {
    return $this->nombre;
  }

  // Sets ID of this post.
  public function setNombre($nombre) 
  {
    $this->nombre = $nombre;
  }

  public function getDescripcion() 
  {
    return $this->descripcion;
  }

  // Sets ID of this post.
  public function setDescripcion($descripcion) 
  {
    $this->descripcion = $descripcion;
  }

 public function getPrecio() 
  {
    return $this->precio;
  }

  // Sets ID of this post.
  public function setPrecio($precio) 
  {
    $this->precio = $precio;
  }

  public function getStock() 
  {
    return $this->stock;
  }

  // Sets ID of this post.
  public function setStock($stock) 
  {
    $this->stock = $stock;
  }

}