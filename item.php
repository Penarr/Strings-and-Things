<?php

/**
 * 
 * Robert Peña, 000738570
 * A class to create item objects
 * Implements JsonSerializable
 * December 6 2019
 * 
 */

class item implements JsonSerializable
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $manufacturer;
    /**
     * @param [$id] [id of the store item]
     * @param [$name] [name of item]
     * @param [$price] [price of item]
     * @param [$manufacturer] [item's manufacturer]
     * @param [$description] [description of item]
     */
    public function __construct($id, $name, $price, $manufacturer, $description)
    {
        $this->id = (int) $id;
        $this->name = $name;
        $this->price = (float) $price;
        $this->description = $description;
        $this->manufacturer = $manufacturer;
    }

    /**
     * Return object values in JSON
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
