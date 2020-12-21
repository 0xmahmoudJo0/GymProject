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
    email.onblur = function () {
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
    password.onblur = function () {
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
submit_btn.addEventListener('click', function () {
    const url = "http://localhost/GymProject-main/GymProject-main/routing/client.php/auth";
    const data = {
        email: input_email.value,
        password: input_password.value
    };
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data)
    }).then(res =>     
            res.json()
    )
    .then((data) => {
        localStorage.setItem($data);
      })        
      .catch(e=>console.log(e));
})

