<?php


/**
 *
 */
abstract class Calendar
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var string
     */
    private $eventDescription;

    /**
     * @var int
     */
    private $calendarID;

    /**
     * @var datetime
     */
    private $eventDateTime;

    /**
     *
     */
    public function Create():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function Edit():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function Delete():void
    {
        // TODO: implement here
    }
}
