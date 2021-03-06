<?php

namespace Elfiggo\Brobdingnagian\Listener;

use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Console\IO;
use PhpSpec\Event\SpecificationEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ClassListener
 * @package Elfiggo\Brobdingnagian\Listener
 */
class ClassListener implements EventSubscriberInterface
{
    /**
     * @var Detector
     */
    private $detector;
    /**
     * @var IO
     */
    private $io;

    /**
     * @param Detector $detector
     * @param Params   $params
     * @param Reporter $reporter
     * @param IO       $io
     */
    public function __construct(Detector $detector, Params $params, Reporter $reporter, IO $io)
    {
        $this->detector = $detector;
        $this->params = $params;
        $this->reporter = $reporter;
        $this->io = $io;
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
            'afterSuite' => array(array('displayErrors', 15), array('generateCsv', 15)),
        );
    }


    /**
     * @param SpecificationEvent $specificationEvent
     */
    public function performBrobdingnagian(SpecificationEvent $specificationEvent)
    {
        $this->detector->analyse($specificationEvent, $this->params, $this->reporter);
    }

    public function displayErrors()
    {
        if ($this->params->getBrobList()) {
            $this->reporter->output($this->io);
        }
    }

    public function generateCsv()
    {
        if ($this->params->getCsv()) {
            $this->reporter->csvOutput();
        }
    }
}
