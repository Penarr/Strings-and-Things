<?php

/**
 * 
 * Robert Peña, 000738570
 * A class to create items that have been placed in a user's shopping cart.
 * Implements JsonSerializable
 * December 6 2019
 * 
 */

class cart_item implements JsonSerializable
{
    private $order_item_id;
    private $item_id;
    private $order_id;
    private $quantity;
    private $price;
    /**
     * @param [$order_item_id] [id of this specific row in the database]
     * @param [$item_id] [id of the item being ordered]
     * @param [$order_id] [id of the order this belongs to]
     * @param [$quantity] [quantity of item]
     * @param [$price] [total price of every quantity of item]
     */
    public function __construct($order_item_id, $item_id, $order_id, $quantity, $price)
    {
        $this->order_item_id = (int) $order_item_id;
        $this->item_id = (int) $item_id;
        $this->order_id = (int) $order_id;
        $this->quantity = (int) $quantity;
        $this->price = (float) $price;
    }
    /**
     * Return object values in JSON
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
