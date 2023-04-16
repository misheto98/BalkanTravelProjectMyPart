const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");

function signupButtonClick(){
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
  return false;
}

function loginButtonClick(){
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
}

function backButtonClick() {
  console.log("Back");
  location.href="../HomePage/HomePage.php";
}
