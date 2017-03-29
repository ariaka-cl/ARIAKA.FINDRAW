<?php
namespace Ventas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class VentasController extends AbstractActionController
{
    public function indexAction()
    {
        $this-> layout()-> setTemplate('layout/layout.phtml');
    }

    public function addAction()
    {
        $this-> layout()-> setTemplate('layout/layout.phtml');  
       
    }
}