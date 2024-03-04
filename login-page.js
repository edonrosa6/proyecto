const loginForm = document.getElementById("login-form");
const loginButton = document.getElementById("ingresar");
const loginErrorMsg = document.getElementById("error-msg");

//When the login button is clicked, the following code is executed
loginButton.addEventListener("click", (e) => {
  //Prevent the default submission of the form
  e.preventDefault();
  //Get the values input by the user in the form fields
  const username = loginForm.usuario.value;
  const password = loginForm.contraseña.value;

  if (username === "editor" && password === "EDITOR") {
    //If the credentials are valid, show an alert box and reload the page
    //alert("Bienvenido");
    //location.reload();    //Reload page
    window.location.href = "Calibrations/table.php";
  } else if (username === "miron" && password === "MIRON") {
    window.location.href = "Calibrations/table2.html";
  } else {
    // Otherwise, make the login error message show (change its oppacity)
    loginErrorMsg.style.opacity = 1;
  }
  if (username === "editor2" && password === "EDITOR2") {
    //If the credentials are valid, show an alert box and reload the page
    //alert("Bienvenido");
    //location.reload();    //Reload page
    window.location.href = "Maintenance/Mtable.html";
  } else if (username === "miron2" && password === "MIRON2") {
    window.location.href = "Maintenance/Mtable2.html";
  } else {
    // Otherwise, make the login error message show (change its oppacity)
    loginErrorMsg.style.opacity = 1;
  }
});
