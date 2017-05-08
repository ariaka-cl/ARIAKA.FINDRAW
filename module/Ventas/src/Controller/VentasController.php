<?php

namespace Ventas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ventas\Entity\Productos;
use Ventas\Entity\Ventas;
use Ventas\Entity\DetalleVenta;
use Zend\View\Model\JsonModel;

class VentasController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    // Constructor method is used to inject dependencies to the controller.
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {
        $this->layout()->setTemplate('layout/layout.phtml');
        $venta = $this->entityManager->getRepository(Productos::Class)
                ->findAll();
        return new ViewModel(['venta' => $venta]);
    }

    public function addAction() {
        $this->layout()->setTemplate('layout/layout.phtml');
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromRoute('id');
            $data = $this->getRequest()->getPost()->toArray();
            foreach ($data as $value) {
                $len = sizeof($value);
                for ($i = 0; $i < $len; $i++) {
                    $detalleVenta = new DetalleVenta();
                    $detalleVenta->setVentaId($id);
                    $detalleVenta->setProductosId($value[$i]['Producto']);
                    $detalleVenta->setCantidad($value[$i]['Cantidad']);
                    $detalleVenta->setFecha($value[$i]['Fecha']);
                    $this->entityManager->persist($detalleVenta);
                }
            }
            $this->entityManager->flush();
        } else {
            $id = $this->params()->fromRoute('id');
            return new ViewModel(['id' => $id]);
        }
    }

    public function productosAction() {
        $productos = $this->entityManager->getRepository(Productos::Class)
                ->findAll();

        foreach ($productos as $value) {
            $data[] = array('Id' => $value->getId(),
                'Codigo' => $value->getCodigo(),
                'Nombre' => $value->getNombre(),
                'Descripcion' => $value->getDescripcion(),
                'Precio' => $value->getPrecio(),
                'Stock' => $value->getStock());
        }
        return new JsonModel(['Productos' => $data]);
    }

    public function listaVentasAction() {
        $ventas = $this->entityManager->getRepository(Ventas::Class)
                ->findAll();

        foreach ($ventas as $value) {
            $data[] = array('Id' => $value->getId(),
                'OrdenCompra' => $value->getOrdenCompra(),
                'FechaCreacion' => $value->getFechaCreacion(),
                'FechaCompra' => $value->getFechaCompra(),
                'FechaEntrega' => $value->getFechaEntrega());
        }
        return new JsonModel(['Ventas' => $data]);
    }

    public function createAction() {

        $venta = new Ventas();
        $venta->setFechaCreacion(date('Y-m-d'));
        $venta->setUsuarioID('1');
        $venta->setOrdenCompra(date('mdy'));
        $this->entityManager->persist($venta);
        $this->entityManager->flush();

        $id = $venta->getId();

        if ($id !== NULL) {
            return $this->redirect()->toRoute('ventas', ['action' => 'add', 'id' => $id]);
        }
    }
    
    public function listaDetalleVentaAction(){
        $id = $this->params()->fromRoute('id');
        $detalleVenta = $this->entityManager->getRepository(DetalleVenta::Class)
                ->findBy(['ventaId'=>$id]); 
        $productos = $this->entityManager->getRepository(Productos::Class)->findAll();//findBy(['id'=>$id]);
        foreach ($productos as $value) {
            $dataProdu[] = array('Id' => $value->getId(),
                'Codigo' => $value->getCodigo(),
                'Nombre' => $value->getNombre(),
                'Descripcion' => $value->getDescripcion(),
                'Precio' => $value->getPrecio(),
                'Stock' => $value->getStock());
                
        }
        
        foreach ($detalleVenta as $value) {
            $data[] = array('Id' => $value->getId(),
                'VentasId' =>$value->getVentaId(), 
                'ProductoID' => $value->getProductosId(),
                'Producto' => $this->_getProductoCode($value->getProductosId(),$dataProdu),
                'Cantidad' => $value->getCantidad(),
                'Fecha' => $value->getFecha());
                
        }
        return new JsonModel(['DetalleVenta' => $data]);        
    }
    
    public function _getProductoCode($id,$listProductos) {
        foreach ($listProductos as $value) {
           if($value['Id']== $id){
               return $value['Codigo'];
           }
        }
        return '';
    }
    
    public function deleteAction() {
        $id = $this->params()->fromRoute('id',0);       
        $detalleVenta = $this->entityManager->getRepository(DetalleVenta::Class)
                ->findBy(['id' => $id]);
        if ($detalleVenta == null) {            
            return;
        }
         foreach ($detalleVenta as $dv) {
              $this->entityManager->remove($dv);
         }       
        $this->entityManager->flush();       
        return;
    }

}
