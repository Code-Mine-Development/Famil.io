<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 25/06/15
 * Time: 23:34
 */

namespace Famillio\Event;


use ArrayAccess;
use Zend\EventManager\EventInterface;

/**
 * Class AbstractDomainEvent
 *
 * @package Famillio\Event
 */
abstract class AbstractDomainEvent implements EventInterface, DomainEventInterface
{
    private $entity;

    private $params;

    private $courenceTime;

    private $type;

    /**
     * Get event name
     *
     * @return string
     */
    public function getName()
    {
        return static::name();
    }

    /**
     * Get target/context from which event was triggered
     *
     * @return \AGmakonts\DddBricks\Entity\EntityInterface
     */
    public function getTarget()
    {
        return $this->entity;
    }

    /**
     * Get a single parameter by name
     *
     * @param  string $name
     * @param  mixed  $default Default value to return if parameter does not exist
     *
     * @return mixed
     */
    public function getParam($name, $default = NULL)
    {
        return $this->getParams()[$name];
    }

    /**
     * Set the event name
     *
     * @param  string $name
     *
     * @return void
     */
    public function setName($name)
    {
        // TODO: Implement setName() method.
    }

    /**
     * Set the event target/context
     *
     * @param  null|string|object $target
     *
     * @return void
     */
    public function setTarget($target)
    {
        // TODO: Implement setTarget() method.
    }

    /**
     * Set event parameters
     *
     * @param  string $params
     *
     * @return void
     */
    public function setParams($params)
    {
        // TODO: Implement setParams() method.
    }

    /**
     * Set a single parameter by key
     *
     * @param  string $name
     * @param  mixed  $value
     *
     * @return void
     */
    public function setParam($name, $value)
    {
        // TODO: Implement setParam() method.
    }

    /**
     * Indicate whether or not the parent EventManagerInterface should stop propagating events
     *
     * @param  bool $flag
     *
     * @return void
     */
    public function stopPropagation($flag = TRUE)
    {
        // TODO: Implement stopPropagation() method.
    }

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool
     */
    public function propagationIsStopped()
    {
        // TODO: Implement propagationIsStopped() method.
    }
}