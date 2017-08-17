<?php
namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Entity\Usuario;
use Usuarios\Entity\Role;
use Zend\View\Model\JsonModel;

class UsuariosController extends AbstractActionController {
    

 private $entityManager;

    // Constructor method is used to inject dependencies to the controller.
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {
        $this->layout()->setTemplate('layout/layout.phtml');
        $usuarios = $this->entityManager->getRepository(Usuario::Class)
                ->findAll();
        $roles = $this->entityManager->getRepository(Role::Class)
                ->findAll();

        foreach ($roles as $value) {
            $listRoles[] = array('Id' => $value->getId(),                
                            'Nombre' => $value->getNombre());
        }
        
        foreach ($usuarios as $usuario) {
            $listUsers[] = array('ID' => $usuario->getId(),
                'Nombre' => $usuario->getNombre(),
                'Rut' => $usuario->getRut(),
                'Nick' => $usuario->getUserName(),                
                'RoleID' => $usuario->getRolId(),
                'Role' => $this->_getRolName($usuario->getRolId(),$listRoles));
        }
        return new ViewModel(['Usuarios' => $listUsers]);
    }

    public function addAction(){
        if ($this->getRequest()->isPost()) {            
            $data = $this->getRequest()->getPost()->toArray();
            foreach ($data as $value) {                
                if(strlen($value['ID']) > 0 ){
                     $usuario = $this->entityManager->getRepository(Usuario::Class)
                     ->findBy(['id'=>$value['ID']]);
                    $usuario->setNombre($value['Nombre']);
                    $usuario->setRut($value['Run']);
                    $usuario->setUserName($value['Nick']);
                    $usuario->setPass($value['Pass']);
                    $usuario->setRolId($value['Rol']);
                    $this->entityManager->persist($usuario);
                }else {
                    $usuario = new Usuario();                    
                    $usuario->setNombre($value['Nombre']);
                    $usuario->setRut($value['Run']);
                    $usuario->setUserName($value['Nick']);
                    $usuario->setPass($value['Pass']);
                    $usuario->setRolId($value['Rol']);
                    $this->entityManager->persist($usuario);   
                }
            }
        $this->entityManager->flush();
        return new JsonModel(['Add' => 'OK']);    
        }        
    }
    
    public function rolesAction() {
        $roles = $this->entityManager->getRepository(Role::Class)
                ->findAll();

        foreach ($roles as $value) {
            $data[] = array('Id' => $value->getId(),                
                            'Nombre' => $value->getNombre());
        }
        return new JsonModel(['Role' => $data]);
    }
    
    public function userslistAction() {
        $usuarios = $this->entityManager->getRepository(Usuario::Class)
                ->findAll();

        foreach ($usuarios as $usuario) {
            $listUsers[] = array('Nombre'=> $usuario->getNombre(),
                                 'Rut' => $usuario->getRut(),
                                 'Nick' => $usuario->getUserName(),
                                 'Pass' => $usuario->getPass(),
                                 'Role' => $usuario->getRolId());
        }
        return new JsonModel(['Usuarios' => $listUsers]);
    }
    
    public function _getRolName($id,$listRoles) {
        foreach ($listRoles as $value) {
           if($value['Id']== $id){
               return $value['Nombre'];
           }
        }
        return '';
    }
    
    public function getuserAction(){
        $id = $this->params()->fromRoute('id');
        $usuarios = $this->entityManager->getRepository(Usuario::Class)
                ->findBy(['id'=>$id]); 
             
        $roles = $this->entityManager->getRepository(Role::Class)
                ->findAll();
        
        foreach ($roles as $value) {
            $listRoles[] = array('Id' => $value->getId(),                
                            'Nombre' => $value->getNombre());
        }
        
        foreach ($usuarios as $usuario) {
            $listUsers[] = array('ID' => $usuario->getId(),
                'Nombre' => $usuario->getNombre(),
                'Rut' => $usuario->getRut(),
                'Nick' => $usuario->getUserName(),                
                'RoleID' => $usuario->getRolId(),
                'Role' => $this->_getRolName($usuario->getRolId(),$listRoles));
        }
        
        return new JsonModel(['Usuario' => $listUsers]);
        
    }
    
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost()->toArray();
            $id = $data['id'];
            $usuario = $this->entityManager->getRepository(Usuario::Class)
                    ->findBy(['id' => $id]);
            if ($usuario == null) {
                return new JsonModel(['Usuarios' => '']);
            }
            foreach ($usuario as $usr) {
                $this->entityManager->remove($usr);
            }
            $this->entityManager->flush();
            return new JsonModel(['Usuarios' => 'OK']);
        }
        return new JsonModel(['Usuarios' => '']);
    }

}