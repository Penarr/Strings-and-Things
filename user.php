<?php

/**
 * 
 * Robert Peña, 000738570
 * A class to create user objects
 * Implements JsonSerializable
 * December 6 2019
 * 
 */

class user implements JsonSerializable
{
    private $id;
    private $username;
    private $password;

    /**
     * @param [$id] [a user's id]
     * @param [$username] [a user's alias on the website]
     * @param [$password] [the user's password]
     */
    public function __construct($id, $username, $password)
    {
        $this->id = (int) $id;
        $this->username = $username;
        $this->password = $password;
    }
    /**
     * Return object values in JSON
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
