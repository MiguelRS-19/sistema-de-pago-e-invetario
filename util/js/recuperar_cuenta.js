$(document).ready(function(){
  $('#aviso1').hide();
  $('#aviso').hide();
  $('#form-recuperar').submit(e=>{
    $('#aviso1').hide();
    $('#aviso').hide();
    Mostrar_Loader('Recuperar_password');
    let dni = $('#dni-recuperar').val();
    let email = $('#email-recuperar').val();
    //console.log(email);
    if(email == '' || dni == ''){
      $('#aviso').show();
      $('#aviso').text('Rellene todo los campos');
      Cerrar_Loader("");
    }else{
      $('#aviso').hide();
      let funcion = 'verificar';
      $.post('../controllers/recuperarController.php',{funcion,dni,email},(response)=>{
        if(response == 'encontrado'){
          let funcion = 'recuperar';
          $('#aviso').hide();
          $.post('../controllers/recuperarController.php',{funcion,dni,email},(response2)=>{
            $('#aviso1').hide();
            $('#aviso').hide();
            console.log(response2);
            if(response2 == 'enviado'){
              Cerrar_Loader('exito_envio');
              $('#aviso1').show();
              $('#aviso1').text('Se restablecio la contraseña.');
              $('#form-recuperar').trigger('reset');
            }else{
              Cerrar_Loader('error_envio');
              $('#aviso').show();
              $('#aviso').text('No se pudo restablecer.');
              $('#form-recuperar').trigger('reset');
            }
          });
        }else{
          Cerrar_Loader('error_usuario');
          $('#aviso1').hide();
          $('#aviso').hide();
          $('#aviso').show();
          $('#aviso').text('El correo y el dni no se encuentran asociados o no estan registrados en el sistema.');
        }
      })
    }
    e.preventDefault();

  });

  function Mostrar_Loader(Mensaje){
    var texto = null;
    var mostrar = false;
    switch (Mensaje) {
      case 'Recuperar_password':
        texto = 'Se esta enviando el correo, Porfavor espere...';
        mostrar = true;
        break;
    }
    if(mostrar){
      Swal.fire({
        title: "Enviando correo",
        text: texto,
        showConfirmButton: false,
      });
    }

  }

  function Cerrar_Loader(Mensaje){
    var tipo = null;
    var texto = null;
    var mostrar = false;
    switch (Mensaje) {
      case 'exito_envio':
        tipo = 'success';
        texto = 'El correo fue enviado correctamente.';
        mostrar = true;
        break;
        case 'error_envio':
          tipo = 'error';
          texto = 'El correo no pudo enviarse, porfavor intente de nuevo.';
          mostrar = true;
          break;
          case 'error_usuario':
            tipo = 'error';
            texto = 'El usuario perteneciente a estos datos no fue encontrado.';
            mostrar = true;
            break;
    
      default:
        swal.close();
        break;
    }
    if(mostrar){
      Swal.fire({
        position: 'center',
        icon: tipo,
        text: texto,
        showConfirmButton: false,
      });
    }
  }
});