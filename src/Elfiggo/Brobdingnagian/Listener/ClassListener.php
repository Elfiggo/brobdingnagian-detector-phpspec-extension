<?php

namespace Elfiggo\Brobdingnagian\Listener;

use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\LoggerHandler;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\Event\SuiteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClassListener implements EventSubscriberInterface
{
    /**
     * @var Detector
     */
    private $detector;
    /**
     * @var LoggerHandler
     */
    private $logger;

    public function __construct(Detector $detector, Params $params, Reporter $reporter, LoggerHandler $logger)
    {
        $this->detector = $detector;
        $this->params = $params;
        $this->reporter = $reporter;
        $this->logger = $logger;
    }
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            'afterSpecification' => array('performBrobdingnagian', 15),
            'afterSuite' => array('displayErrors', 15)
        );
    }


    /**
     * @param SpecificationEvent $specificationEvent
     * @return \PhpSpec\Loader\Node\ExampleNode
     */
    public function performBrobdingnagian(SpecificationEvent $specificationEvent)
    {
        $this->detector->analyse($specificationEvent, $this->params, $this->reporter);
    }

    public function displayErrors()
    {
        if ($this->logger->messages()) {
            $this->logger->output();
        }
    }

}
