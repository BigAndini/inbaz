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
use Zend\View\Model\JsonModel;

class CalendarController extends AbstractActionController
{
    public function indexAction()
    {
        #$this->layout()->setVariable('fluid', true);
        return new ViewModel();
    }
    
    public function eventsAction() {
        $start = $this->params()->fromQuery('start');
        $end = $this->params()->fromQuery('end');
        
        return new JsonModel(array(
            array(
                'id' => '1',
                'title' => 'event 1',
                'allDay' => false,
                'start' => '2016-12-23T22:00:00Z',
                'end' => '2016-12-25T22:00:00Z',
                'url' => '/event/1',
                'editable' => false,
            ),
            array(
                'id' => '2',
                'title' => 'event 2',
                'allDay' => false,
                'start' => '2016-12-28T22:00:00Z',
                'end' => '2016-12-31T22:00:00Z',
                'url' => '/event/2',
                'editable' => false,
            ),
        ));
    }
}
