<?php
namespace Usuarios\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class Usuario
{
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
  /** 
   * @ORM\Column(name="Rut")  
   */
  protected $rut;
  /** 
   * @ORM\Column(name="UserName")  
   */
  protected $userName;
  /** 
   * @ORM\Column(name="Pass")  
   */
  protected $pass;
  /** 
   * @ORM\Column(name="RoleID")  
   */
  protected $rolId;
  
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
  
  public function getRut() 
  {
    return $this->rut;
  }
  
  public function setRut($rut) 
  {
    $this->rut = $rut;
  }
  
  public function getUserName() 
  {
    return $this->userName;
  }
  
  public function setUserName($userName) 
  {
    $this->userName = $userName;
  }
  
  public function getPass() 
  {
    return $this->pass;
  }
  
  public function setPass($pass) 
  {
    $this->pass = $pass;
  }
  
  public function getRolId() 
  {
    return $this->rolId;
  }
  
  public function setRolId($rolId) 
  {
    $this->rolId = $rolId;
  }
    
}
