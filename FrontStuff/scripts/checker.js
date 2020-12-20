var input_name = document.getElementById('name');
var input_email = document.getElementById('email');
var input_password = document.getElementById('password');
var input_confirm_password = document.getElementById('confirm_password');
var error_password = document.getElementById('password_error');
var error_confirm = document.getElementById('confirm_error');
function Type_error(x) {
x.style.borderBottom = '2px solid red';
};
function Type_success(x) {
x.style.borderBottom = '2px solid green';
};
function error_check(input) {
	input.onblur = function() {
		if (/([0-9])$/.test(input.value) === true) {
		Type_error(input);
		}
		else if (input.value == "") {
		Type_error(input);
		}
		else {
		Type_success(input);
		};
	}
};
function email_check(email) {
	email.onblur = function() {
		if (email.value.includes("@" && ".")) {
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
function confirm_password_relation(password, confirm_password, error_confirm) {
	if (confirm_password.value != "") {
			if (password.value == confirm_password.value) {
				error_confirm.style.display = "none";
				Type_success(confirm_password)
			}
			else {
				error_confirm.style.display = "block";
				Type_error(confirm_password)
			}
		}
};
function password_check(password, error, confirm_password, error_confirm) {
	password.onblur = function() {
		if (password.value == "") {
			Type_error(password);
			confirm_password_relation(password, confirm_password, error_confirm);
			if (confirm_password == "") {
			error_confirm.style.display = "none";
			Type_success(confirm_password);
			}
		}
		else if (password.value.length < 8) {
			error.style.display = "block";
			Type_error(password);
			confirm_password_relation(password, confirm_password, error_confirm);
		} 
		else {
			error.style.display = "none";
			Type_success(password);
			confirm_password_relation(password, confirm_password, error_confirm);
		};
	};
	confirm_password.onblur = function() {
		if (password.value != confirm_password.value) {
			error_confirm.style.display = "block";
			Type_error(confirm_password);
		}
		else if (confirm_password.value == "") {
			if (password.value == ""){
				error_confirm.style.display = "none";
				Type_success(confirm_password);
			}
		} 
		else {
			error_confirm.style.display = "none";
			Type_success(confirm_password);
		}
	};
};
error_check(input_name);
email_check(input_email);
password_check(input_password, error_password, input_confirm_password, error_confirm);

