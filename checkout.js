/**
 * Robert Peña, 000738570
 *
 * December 6 2019
 * Javascript file that runs the script for the checkout process. Will make orders as complete and add the final total price based on the
 * items the user added to their cart. Will inform them if their cart is empty and the order is not sent
 */
window.addEventListener("load", function () {
    //Saves  orderId
    
    let orderIdInput = document.createElement("input");
    orderIdInput.setAttribute("type", "hidden");
    orderIdInput.id = "orderIdInput";
    //Adds orderIdInput that will save a the orderId value to work around scope
    document.body.appendChild(orderIdInput);
    //Opens order
    console.log()
    fetch("php/open_order.php", {
        method: "POST",
        credentials: "include",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "userId=" + document.getElementById("userIdInput").value

    }).then(response => response.json())
    .then(getTotalPrice)
    //Gets total price of every item in the cart
    function getTotalPrice(order){ 
        orderIdInput.value = order[0].order_id;
        fetch("php/get_order_price.php", {
            method: "POST",
            credentials: "include",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "orderId=" + order[0].order_id
        }).then(response => response.text())
        .then(finishOrder)
    }
    
    //Marks order as finished if the price is above 0,
    //Informs user if order has no items
    function finishOrder(price){
        if(price <= 0.00){
            document.getElementById("noItemsInOrder").innerHTML = "Please add items to order";
        }
        else{
            
            fetch("php/finish_order.php", {
                method: "POST",
                credentials: "include",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "orderId=" + document.getElementById("orderIdInput").value + "&price=" + price
        
            }).then(response => response.text())
            .then(readOrder)
        }
        
    }
    
    //Informs user of the total price of the order
    function readOrder(price){
        console.log(price);
        document.getElementById("orderDetails").innerHTML = "Order total: $" + price;
    }
    
});