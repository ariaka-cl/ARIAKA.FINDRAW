<?php
namespace Usuarios\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Role")
 */
class Role{
    /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(name="ID")   
   */
  protected $id;
  /** 
   * @ORM\Column(name="Nombre")  
   */
  protected $nombre;
  
  public function getId() 
  {
    return $this->id;
  }
  
  public function setId($id) 
  {
    $this->id = $id;
  }
  
  public function getNombre() 
  {
    return $this->nombre;
  }
  
  public function setNombre($nombre) 
  {
    $this->nombre = $nombre;
  }
    
}