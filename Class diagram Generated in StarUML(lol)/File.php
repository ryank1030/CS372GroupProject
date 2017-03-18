<?php


/**
 *
 */
abstract class File
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
    private $name;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $size;

    /**
     * @var date
     */
    private $Created;

    /**
     * @var date
     */
    private $Modified;

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

    /**
     *
     */
    public function Copy():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function View():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function Destroy File Class():void
    {
        // TODO: implement here
    }
}
