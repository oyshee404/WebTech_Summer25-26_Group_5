console.log("Gym Management System Connected");

function collect_data(){
    let valid = true;
    let message = "";

    let name = document.getElementById("name");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let confirmPassword = document.getElementById("confirmPassword");

    if(name && name.value.trim().length < 5){
        message += "Name/Username must be at least 5 characters.\n";
        valid = false;
    }

    if(email && email.value.trim() === ""){
        message += "Email cannot be empty.\n";
        valid = false;
    }

    if(password && password.value.trim().length < 5){
        message += "Password must be at least 5 characters.\n";
        valid = false;
    }

    if(confirmPassword && password && confirmPassword.value !== password.value){
        message += "Passwords do not match.\n";
        valid = false;
    }

    if(!valid){
        alert(message);
    }

    return valid;
}

function confirmDelete(){
    return confirm("Are you sure you want to delete your profile?");
}
