$(document).ready(function(){
  //var funcion;
  $('.select2').select2();
  rellenar_usuarios();
  rellenar_pagos();

  function rellenar_usuarios() {
    let funcion = "rellenar_usuarios";
    $.post('../controllers/UsuarioController.php',{funcion},(response)=>{
      const usuarios = JSON.parse(response);
      let template = '';
      usuarios.forEach(usuario => {
        template+=`
        <option value="${usuario.id}">${usuario.nombre}</option>
        `;
      });
      $('#id_pag').html(template);
      $('#id_pag_mod').html(template);
    });
  }

  function rellenar_pagos() {
    let funcion = "rellenar_pagos";
    $.post('../controllers/MetodoPagoController.php',{funcion},(response)=>{
      const pagos = JSON.parse(response);
      let template = '';
      pagos.forEach(pago => {
        template+=`
        <option value="${pago.id}">${pago.nombre}</option>
        `;
      });
      $('#id_metod').html(template);
      $('#id_metod_mod').html(template);
    });
  }


  $('#form_cuota').submit(e=>{
    let ingreso= $('#ingreso').val();
    let fecha = $('#fecha').val();
    let consumo = $('#consumo').val();
    let plazo = $('#plazo').val();
    let pagador = $('#id_pag').val();
    let pago = $('#id_metod').val();
    funcion = 'crear_cuota';
    //console.log(ingreo+' '+' '+fecha+' '+consumo+' '+plazo+' '+pagador+''+pago);
    /*try {
    } catch (error) {
      console.error('Error en la solicitud AJAX:', error);
      console.error(error);
    }*/
    $.post('../controllers/cuotaController.php',{ingreso,consumo,fecha,plazo,pagador,pago,funcion},(response)=>{
      console.log(response);
      if(response == 'add'){
        $('#add').hide('slow');
        $('#add').show(1000);
        $('#add').hide(2000);
        $('#form_cuota').trigger('reset');
        $('#id_pag').val('').trigger('change');
        $('#id_metod').val('').trigger('change');
        datatable.ajax.reload();
        //buscar_datos();
      }else{
        $('#noadd').hide('slow');
        $('#noadd').show(1000);
        $('#noadd').hide(2000);
        $('#form_cuota').trigger('reset');
        $('#id_pag').val('').trigger('change');
        $('#id_metod').val('').trigger('change');
      }
    });

    e.preventDefault();
  });

  let funcion = "listar";
  let datatable = $('#tabla_cuota').DataTable({
      ajax: {
      "url" : "../controllers/cuotaController.php",
      "method" : "POST",
      "data" : {funcion:funcion}
      },
      columns: [
          { data: 'idcuota' },
          { data: 'consumo' },
          { data: 'fecha_pago' },
          { data: 'pagador' },
          { data: 'cancelar' },
          { data: 'pago' },
          { defaultContent: `
          <td><button class="editar btn btn-circle btn-sm btn-success ml-2" data-toggle="modal" data-target="#modal_edit_cuota"><i class="fas fa-pen-alt"></i></button>       
          ` },
          {
            data: 'estado',
            render: function (data, type, row) {
                let template = '';
                template+=`
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                `;
                if(data == 'no pagado'){
                  template+=`<span class="badge bg-danger text-light">${data}</span>
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>`
                }
                if(data == 'pagado'){
                  template+=`<span class="badge bg-success text-light">${data}
                  </span>
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>`
                };
                template+=`
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Estado:</div>`
                      if(data == 'no pagado'){
                        template+=` <button class="nopagado btn btn-sm btn-danger ml-2 mb-2">No pagado</button>`
                      }
                      if(data == 'pagado'){
                        template+=`<button class="pagado btn btn-sm btn-success ml-2">Pagado</button>`
                      };
                      template+=`<div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Enviado</a>
                  </div>
                </div>
                `;
                return template;
            }
          }
      ],
      "language": espanol
  });

  //Opcion de capturar cuota al modal
  $('#tabla_cuota tbody').on('click','.editar',function() {
    let datos = datatable.row($(this).parents()).data();
    let id = datos.idcuota;
    let funcion = 'obtener_fecha';
    $.post('../controllers/cuotaController.php',{funcion,id},(response)=>{
      const json = JSON.parse(response);
      //console.log(json.consumo);
      $("#idcuota_mod").val(datos.idcuota);
      $("#ingreso_mod").val(datos.cancelar.replace('S/', '')); // replace quitar caracter obtener numero
      $("#consumo_mod").val(json.consumo); // replace quitar caracter
      $("#fecha_mod").val(datos.fecha_pago);
      //$("#plazo_mod").val(datos.plazo);
      $("#id_pag_mod").val(datos.user).trigger('change');
      $("#id_metod_mod").val(datos.idpago).trigger('change');
    })
    
  });

  //Modal de editar cuota
  $("#form_edit_cuota").submit(e=>{
    let idcuota_mod= $('#idcuota_mod').val();
    let ingreso_mod= $('#ingreso_mod').val();
    let consumo_mod= $('#consumo_mod').val();
    let fecha_mod= $('#fecha_mod').val();
    let plazo_mod= $('#plazo_mod').val();
    let id_pag_mod= $('#id_pag_mod').val();
    let id_metod_mod= $('#id_metod_mod').val();
    let funcion = "editar";
    $.post('../controllers/cuotaController.php',{idcuota_mod,funcion,ingreso_mod,consumo_mod,fecha_mod,plazo_mod,id_pag_mod,id_metod_mod}, (response)=>{
      console.log(response);
      if (response == 'edit'){
        $('#edit').hide('slow');
        $('#edit').show(1000);
        $('#edit').hide(2000);
        $('#form_edit_cuota').trigger('reset');
        $('#id_pag_mod').val('').trigger('change');
        $('#id_metod_mod').val('').trigger('change');
        // Reload DataTable
        datatable.ajax.reload();
      }else{
        $('#noedit').hide('slow');
        $('#noedit').show(1000);
        $('#noedit').hide(2000);
        $('#form_edit_cuota').trigger('reset');
        $('#id_pag_mod').val('').trigger('change');
        $('#id_metod_mod').val('').trigger('change');
      }
      
    })
    e.preventDefault();
  });

  //Opcion de capturar cuota al modal
  $('#tabla_cuota tbody').on('click','.nopagado',function() {
    let datos = datatable.row($(this).parents()).data();

    let id = datos.idcuota;
    funcion = "nopagado";
    let idcuota= datos.idcuota;
    let estado = datos.estado;
    let ingreso = datos.pago;
    $.post('../controllers/cuotaController.php',{funcion,idcuota,estado,ingreso},(response)=>{
      console.log(response);
      if (response == 'cambiado'){
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Se cambio su estado: Pagado",
          showConfirmButton: false,
          timer: 1500
          
        });
        datatable.ajax.reload();
      }else{
        Swal.fire({
          position: "center",
          icon: "error",
          title: "No fue cambio su estado: No Pagado",
          showConfirmButton: false,
          timer: 1500
          
        });
        datatable.ajax.reload();
      }
    })
    console.log(estado+' '+idcuota);
    
  });

  $('#tabla_cuota tbody').on('click','.pagado',function() {
    let datos = datatable.row($(this).parents()).data();

    let id = datos.idcuota;
    funcion = "pagado";
    let idcuota= datos.idcuota;
    let estado = datos.estado;
    let ingreso = datos.pago;
    //console.log(estado+''+idcuota);
    $.post('../controllers/cuotaController.php',{funcion,idcuota,estado,ingreso},(response)=>{
      console.log(response);
      if (response == 'cambiado'){
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Se cambio su estado: No Pagado",
          showConfirmButton: false,
          timer: 1500
          
        });
        datatable.ajax.reload();
      }else{
        Swal.fire({
          position: "center",
          icon: "error",
          title: "No fue cambio su estado: No Pagado",
          showConfirmButton: false,
          timer: 1500
          
        });
        datatable.ajax.reload();
      }
    })
    
  });

});

let espanol = {
  "processing": "Procesando...",
  "lengthMenu": "Mostrar _MENU_ registros",
  "zeroRecords": "No se encontraron resultados",
  "emptyTable": "Ningún dato disponible en esta tabla",
  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
  "search": "Buscar:",
  "loadingRecords": "Cargando...",
  "paginate": {
      "first": "Primero",
      "last": "Último",
      "next": "Siguiente",
      "previous": "Anterior"
  },
  "aria": {
      "sortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sortDescending": ": Activar para ordenar la columna de manera descendente"
  },
  "buttons": {
      "copy": "Copiar",
      "colvis": "Visibilidad",
      "collection": "Colección",
      "colvisRestore": "Restaurar visibilidad",
      "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
      "copySuccess": {
          "1": "Copiada 1 fila al portapapeles",
          "_": "Copiadas %ds fila al portapapeles"
      },
      "copyTitle": "Copiar al portapapeles",
      "csv": "CSV",
      "excel": "Excel",
      "pageLength": {
          "-1": "Mostrar todas las filas",
          "_": "Mostrar %d filas"
      },
      "pdf": "PDF",
      "print": "Imprimir",
      "renameState": "Cambiar nombre",
      "updateState": "Actualizar",
      "createState": "Crear Estado",
      "removeAllStates": "Remover Estados",
      "removeState": "Remover",
      "savedStates": "Estados Guardados",
      "stateRestore": "Estado %d"
  },
  "autoFill": {
      "cancel": "Cancelar",
      "fill": "Rellene todas las celdas con <i>%d<\/i>",
      "fillHorizontal": "Rellenar celdas horizontalmente",
      "fillVertical": "Rellenar celdas verticalmente"
  },
  "decimal": ",",
  "searchBuilder": {
      "add": "Añadir condición",
      "button": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
      },
      "clearAll": "Borrar todo",
      "condition": "Condición",
      "conditions": {
          "date": {
              "before": "Antes",
              "between": "Entre",
              "empty": "Vacío",
              "equals": "Igual a",
              "notBetween": "No entre",
              "not": "Diferente de",
              "after": "Después",
              "notEmpty": "No Vacío"
          },
          "number": {
              "between": "Entre",
              "equals": "Igual a",
              "gt": "Mayor a",
              "gte": "Mayor o igual a",
              "lt": "Menor que",
              "lte": "Menor o igual que",
              "notBetween": "No entre",
              "notEmpty": "No vacío",
              "not": "Diferente de",
              "empty": "Vacío"
          },
          "string": {
              "contains": "Contiene",
              "empty": "Vacío",
              "endsWith": "Termina en",
              "equals": "Igual a",
              "startsWith": "Empieza con",
              "not": "Diferente de",
              "notContains": "No Contiene",
              "notStartsWith": "No empieza con",
              "notEndsWith": "No termina con",
              "notEmpty": "No Vacío"
          },
          "array": {
              "not": "Diferente de",
              "equals": "Igual",
              "empty": "Vacío",
              "contains": "Contiene",
              "notEmpty": "No Vacío",
              "without": "Sin"
          }
      },
      "data": "Data",
      "deleteTitle": "Eliminar regla de filtrado",
      "leftTitle": "Criterios anulados",
      "logicAnd": "Y",
      "logicOr": "O",
      "rightTitle": "Criterios de sangría",
      "title": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
      },
      "value": "Valor"
  },
  "searchPanes": {
      "clearMessage": "Borrar todo",
      "collapse": {
          "0": "Paneles de búsqueda",
          "_": "Paneles de búsqueda (%d)"
      },
      "count": "{total}",
      "countFiltered": "{shown} ({total})",
      "emptyPanes": "Sin paneles de búsqueda",
      "loadMessage": "Cargando paneles de búsqueda",
      "title": "Filtros Activos - %d",
      "showMessage": "Mostrar Todo",
      "collapseMessage": "Colapsar Todo"
  },
  "select": {
      "cells": {
          "1": "1 celda seleccionada",
          "_": "%d celdas seleccionadas"
      },
      "columns": {
          "1": "1 columna seleccionada",
          "_": "%d columnas seleccionadas"
      },
      "rows": {
          "1": "1 fila seleccionada",
          "_": "%d filas seleccionadas"
      }
  },
  "thousands": ".",
  "datetime": {
      "previous": "Anterior",
      "hours": "Horas",
      "minutes": "Minutos",
      "seconds": "Segundos",
      "unknown": "-",
      "amPm": [
          "AM",
          "PM"
      ],
      "months": {
          "0": "Enero",
          "1": "Febrero",
          "10": "Noviembre",
          "11": "Diciembre",
          "2": "Marzo",
          "3": "Abril",
          "4": "Mayo",
          "5": "Junio",
          "6": "Julio",
          "7": "Agosto",
          "8": "Septiembre",
          "9": "Octubre"
      },
      "weekdays": {
          "0": "Dom",
          "1": "Lun",
          "2": "Mar",
          "4": "Jue",
          "5": "Vie",
          "3": "Mié",
          "6": "Sáb"
      },
      "next": "Próximo"
  },
  "editor": {
      "close": "Cerrar",
      "create": {
          "button": "Nuevo",
          "title": "Crear Nuevo Registro",
          "submit": "Crear"
      },
      "edit": {
          "button": "Editar",
          "title": "Editar Registro",
          "submit": "Actualizar"
      },
      "remove": {
          "button": "Eliminar",
          "title": "Eliminar Registro",
          "submit": "Eliminar",
          "confirm": {
              "_": "¿Está seguro de que desea eliminar %d filas?",
              "1": "¿Está seguro de que desea eliminar 1 fila?"
          }
      },
      "error": {
          "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
      },
      "multi": {
          "title": "Múltiples Valores",
          "restore": "Deshacer Cambios",
          "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
          "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
      }
  },
  "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
  "stateRestore": {
      "creationModal": {
          "button": "Crear",
          "name": "Nombre:",
          "order": "Clasificación",
          "paging": "Paginación",
          "select": "Seleccionar",
          "columns": {
              "search": "Búsqueda de Columna",
              "visible": "Visibilidad de Columna"
          },
          "title": "Crear Nuevo Estado",
          "toggleLabel": "Incluir:",
          "scroller": "Posición de desplazamiento",
          "search": "Búsqueda",
          "searchBuilder": "Búsqueda avanzada"
      },
      "removeJoiner": "y",
      "removeSubmit": "Eliminar",
      "renameButton": "Cambiar Nombre",
      "duplicateError": "Ya existe un Estado con este nombre.",
      "emptyStates": "No hay Estados guardados",
      "removeTitle": "Remover Estado",
      "renameTitle": "Cambiar Nombre Estado",
      "emptyError": "El nombre no puede estar vacío.",
      "removeConfirm": "¿Seguro que quiere eliminar %s?",
      "removeError": "Error al eliminar el Estado",
      "renameLabel": "Nuevo nombre para %s:"
  },
  "infoThousands": "."
} 