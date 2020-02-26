<?php

/**
 * 
 * Robert Peña, 000738570
 * A class to create order objects
 * Implements JsonSerializable
 * December 6 2019
 * 
 */

class order implements JsonSerializable
{
    private $order_id;
    private $user_id;
    private $price;
    private $ordered;

    /**
     * @param [order_id][id of order]
     * @param [item_id] [id of user placing the order]
     * @param [price] [price of order]
     * @param [ordered][int to determine if ordered has been placed]
     */
    public function __construct($order_id, $user_id, $price, $ordered)
    {
        $this->order_id = (int) $order_id;
        $this->user_id = (int) $user_id;
        $this->price = (float) $price;
        $this->ordered = (int) $ordered;
    }
    /**
     * Return object values in JSON
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
