$(document).ready(function(){
  verificar_sesion();
  $('#form_usuario').submit(e=>{
    let dni = $('#usuario').val();
    let pass = $('#password').val();
    //console.log(user+' '+pass);
    login(dni,pass);

    e.preventDefault();
  });

  async function login(dni,pass){
    let funcion = "login";
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion+'&&dni='+dni+'&&pass='+pass

    })
    if(data.ok){
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        //console.log(respuesta);
        if(respuesta.mensaje == 'success'){
          Swal.fire({
            icon: "success",
            title: "Logueo",
            text: "Se logueo exsitosamente!!!",
            showConfirmButton: false,
            timer: 1800
          }).then(() => {
            location.href = "control";
          });
        }else if(respuesta.mensaje == 'error_pass'){
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Usuario y/o contraseña incorrecta no tiene permiso para acceder al sistema.",
          });
          $('#form_usuario').trigger('reset');
        }else if(respuesta.mensaje == 'error'){
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Usuario y/o contraseña incorrecta no tiene permiso para acceder al sistema.",
          });
          $('#form_usuario').trigger('reset');
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }

  async function verificar_sesion(){
    let funcion = "verificar_sesion";
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion

    })
    if(data.ok){
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if(respuesta.length != 0){
          location.href = "catalogo";
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }
});