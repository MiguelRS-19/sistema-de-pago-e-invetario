$(document).ready(function(){
  $('#form_register').submit(e=>{
    let username = $('#username').val();
    let oldpass = $('#oldpass').val();
    let newpass = $('#newpass').val();
    //console.log(username+' '+oldpass);
    var funcion = 'register';
    $.post('../controllers/UsuarioController.php',{username,oldpass,funcion},(response)=>{
      console.log(response);
      if(username == '' && oldpass == '' && newpass == ''){
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Este campo es obligatorio...",
        });
      }else{
        if(oldpass !== newpass){
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "La contraseña no coinciden con la antigua.",
          });
        }else{
          if (response == 'register') {
            Swal.fire({
              icon: "success",
              title: "Registró",
              text: "Se registró exsitosamente!!!",
              showConfirmButton: false,
              timer: 1800
            });
          } else {
            Swal.fire({
              icon: "warning",
              title: "No Registró",
              text: "No se registró exsitosamente!!!",
              timer: 9900
            });
            window.location.href = "register.php";
          }
        }
      }
    });

    e.preventDefault();
  });

});