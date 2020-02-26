/**
 * Robert Peña, 000738570
 *
 * December 6 2019
 * Javascript file that runs the script for the registration process. Validates the password and username.
 * Sends them to the database as a new user
 */
window.addEventListener("load", function () {
    /**
     * Adds a new user if their username and password is valid.
     * If the information is not valid, it will not add them to the database and will inform them so.
     * Also informs the user if they created a new account.
     * @param {*} users 
     */
    function validateNewUser(users) {
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
        document.getElementById("status").innerHTML = "";
        let i = 0;
        /**
         * Boolean values that are marked as true if a password has at least 1 uppercase,
         * 1 lowercase and 1 number.
         * 
         */
        let hasUpper = false;
        let hasLower = false;
        let hasNumber = false;
        while (i < password.length) {
            if (password.charAt(i) == password.charAt(i).toUpperCase() && isNaN(password.charAt(i)))
                hasUpper = true;
            if (password.charAt(i) == password.charAt(i).toLowerCase() && isNaN(password.charAt(i)))
                hasLower = true;
            if (!isNaN(password.charAt(i)))
                hasNumber = true;
            i++;
        }
        /**
         * boolean that returns false if user exists in database.
         */
        let newUser = true;
        for (let i = 0; i < users.length; i++) {
            if (username == users[i].username) {
                newUser = false;
                break;
            }

        }
        //If the username is not in use and is longer than 3 characters
        if (newUser && username.length > 3) {
            //If password is at least 8 characters long and has an uppercase, lowercase and a number
            if (password.length > 7 && hasLower && hasUpper && hasNumber) {
                let params = "username=" + username + "&password=" + password;
                fetch("php/add_user.php", {
                    method: "POST",
                    credentials: "include",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: params
                }).then(userCreated)
            } else { //Invalid password
                document.getElementById("status").innerHTML = "Invalid password. Please ensure you are following the guidelines";
            }
        } else { //Invalid username
            document.getElementById("status").innerHTML = "Invalid username. Try something else";
        }
    }
    /**
     * Informs user that they have created a new account
     */
    function userCreated(){
        document.getElementById("status").innerHTML = "User created";
    }
    /**
     * fetch request grabs every existing user from the database table
     */
    function fetchUsers() {
        event.preventDefault();
        document.getElementById("status").innerHTML = "";
        fetch("php/get_users.php", {
                credentials: "include"
            })
            .then(response => response.json())
            .then(validateNewUser)
    }

    this.document.getElementById("register").addEventListener("click", fetchUsers); //triggers user fetch when clicked
});