class User {

    ClearMessages(input) {
        switch (input.name) {
            case "user":
                document.getElementById(input.name).innerHTML = "";
                break;
            case "password":
                document.getElementById(input.name).innerHTML = "";
                break;
        }
    }
}