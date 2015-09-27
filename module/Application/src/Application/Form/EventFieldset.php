<?php   

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form;

use Application\Entity;
use Doctrine\Common\Persistence\ObjectManager;
#use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineModule\Stdlib\Hydrator\Strategy;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class EventFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {        
        parent::__construct('event'); 

        $hydrator = new DoctrineHydrator($objectManager);
        #$hydrator->addStrategy('contacts', new Strategy\DisallowRemoveByValue());
        $this->setHydrator($hydrator)
             ->setObject(new Entity\Event());
       
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
        ));
 
        $this->add(array( 
            'name' => 'heading', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Name...', 
                'required' => 'required', 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Name', 
            ), 
        )); 
        
        $this->add(array( 
            'name' => 'begin', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Anfang...', 
                'required' => 'required', 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Anfang', 
            ), 
        )); 
        
        $this->add(array( 
            'name' => 'end', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Ende...', 
                'required' => 'required', 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Ende', 
            ), 
        )); 
        
        $this->add(array( 
            'name' => 'website', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Webseite...', 
                'required' => 'required', 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Webseite', 
            ), 
        )); 
    }
    
    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false,
                'validators' => array(
                ),
            ),
            'short' => array(
                'required' => true,
                'validators' => array(
                ),
            ),
            'description' => array(
                'required' => true,
                'validators' => array(
                ),
            ),
            /*'price' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Float',
                    ),
                ),
            ),*/
        );
    }
}