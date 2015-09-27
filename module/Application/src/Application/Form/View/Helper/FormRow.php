<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form\View\Helper;

use Zend\Form\View\Helper\FormRow as OriginalFormRow;

class FormRow extends OriginalFormRow
{
    public function __invoke(\Zend\Form\ElementInterface $element = null) {
        switch(get_class($element)) {
            case 'Zend\Form\Element\Radio':
                echo '<div class="radio">';
                echo $this->view->formElement($element);
                echo $this->view->formElementErrors($element);
                echo '</div>';
                break;
            case 'Zend\Form\Element\Text':
                echo '<div class="form-group">';
                echo $this->view->formLabel($element);
                echo $this->view->formElement($element);
                echo $this->view->formElementErrors($element);
                echo '</div>';
                break;
            default:
                error_log("Please implement: ". get_class($element));
        }
        
    }
}