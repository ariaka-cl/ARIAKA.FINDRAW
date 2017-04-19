<?php
namespace Ventas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ventas\Entity\Productos;
use Zend\View\Model\JsonModel;

class VentasController extends AbstractActionController
{
    /**
   * Entity manager.
   * @var Doctrine\ORM\EntityManager
   */
  private $entityManager;
  
  // Constructor method is used to inject dependencies to the controller.
  public function __construct($entityManager) 
  {
    $this->entityManager = $entityManager;
  }
    
    public function indexAction()
    {
        $this-> layout()-> setTemplate('layout/layout.phtml');
        $venta = $this->entityManager->getRepository(Productos::Class)
                ->findAll();
        return new ViewModel(['venta'=> $venta]);
    }

    public function addAction()
    {
        $this-> layout()-> setTemplate('layout/layout.phtml');  

       if($this->getRequest()->isPost()) {

           echo 'console.log("Data posted");';           
            return new ViewModel(array('message'=>"Hola que hace"));
       }else {
            
       }
    }

    public function productosAction()
    {
        $productos = $this->entityManager->getRepository(Productos::Class)
                ->findAll();
        
        foreach ($productos as $value) {
            $data[] = array( 'Codigo' => $value->getCodigo(),
                            'Nombre' => $value->getNombre(),
                            'Descripcion' => $value->getDescripcion(),
                            'Precio' => $value->getPrecio(),
                            'Stock' => $value->getStock());
        }
        return new JsonModel(['Productos' => $data]);       
    }
}