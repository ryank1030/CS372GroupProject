<?php


/**
 *
 */
class Group
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
    private $groupID;

    /**
     * @var int
     */
    private $#ofMembers;

    /**
     * @var int
     */
    private $#ofAdmins;

    /**
     * @var int[]
     */
    private $userIDMembers;

    /**
     * @var int[]
     */
    private $userIDAdmins;

    /**
     * @var int[]
     */
    private $fileIDs;

    /**
     * @var int[]
     */
    private $CalendarIDs;

    /**
     * @var int
     */
    private $chatID;







    /**
     *
     */
    public function CreateGroup():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function AddMember():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function AddAdmin():void
    {
        // TODO: implement here
    }

    /**
     *
     */
    public function KickMember():void
    {
        // TODO: implement here
    }
}
