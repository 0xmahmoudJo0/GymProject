var input_email = document.getElementById('email');
var input_password = document.getElementById('password');
var submit_btn = document.getElementById('submitBtn');

function Type_error(x) {
    x.style.borderBottom = '2px solid red';
};
function Type_success(x) {
    x.style.borderBottom = '2px solid green';
};

function email_check(email) {
    email.onblur = function() {
        if (email.value.includes("(@[a-z])+\w/g" && ".")) {
            Type_success(email);
        }
        else if (email.value == "") {
            Type_error(email);
        }
        else {
            Type_error(email);
        }
    }
};
function password_check(password) {
    password.onblur = function() {
    if (password.value == "") {
        Type_error(password);
    }
    else {
        Type_success(password);
    } 
}
}

email_check(input_email);
password_check(input_password);
addEventListener('click', function() {
     var check_request = new XMLHttpRequest;
    check_request.onreadystatechange = function() {
 	if (this.readyState === 4 && this.status === 200) {
        //code
 	}
 }
 check_request.open("POST", "https://api.com", true);
 check_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 check_request.send("email=" + input_email + "&password=" + input_password);
})

