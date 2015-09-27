<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity;
use Application\Form;

class EventController extends AbstractActionController
{
    public function indexAction() {
        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        return new ViewModel(array(
            'events' => $em->getRepository("Application\Entity\Event")
                ->findAll(),
        ));
    }
    
    public function addAction() {
        $logger = $this->getServiceLocator()->get('Logger');
        
        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        
        $form = new Form\CreateEventForm($em);
        
        $event = new Entity\Event();
        $form->bind($event);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $em->persist($event);
                $em->flush();
                
                return $this->redirect()->toRoute('access-level');
            } else {
                $logger->warn($form->getMessages());
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    public function editAction() {
        $logger = $this->getServiceLocator()->get('Logger');
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('access-level', array(
                'action' => 'add'
            ));
        }
        
        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        
        $form = new Form\CreateEventForm($em);
        
        $event = $em->getRepository("Application\Entity\Event")
                ->findOneBy(array('id' => $id));
        $form->bind($event);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $em->persist($event);
                $em->flush();
                
                return $this->redirect()->toRoute('access-level');
            } else {
                $logger->warn($form->getMessages());
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    public function deleteAction() {
        $logger = $this->getServiceLocator()->get('Logger');
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('access-level');
        }
        
        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        
        $form = new Form\DeleteForm($em);
        
        $event = $em->getRepository("Application\Entity\Event")
                ->findOneBy(array('id' => $id));
        $form->bind($event);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $em->remove($event);
                $em->flush();
                
                return $this->redirect()->toRoute('access-level');
            } else {
                $logger->warn($form->getMessages());
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }
}
