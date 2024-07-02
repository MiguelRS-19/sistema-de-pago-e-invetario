<?php 
include_once 'Venta.php';
include_once 'VentaProducto.php';
include_once 'Empresa.php';

function getHtml($id_venta){
  $venta = new Venta();
  $empresa = new Empresa();
  $venta_producto = new VentaProducto();
  $venta-> obtener_id($id_venta);
  $empresa-> empresa();
  $venta_producto-> obtener($id_venta);
  $plantilla ='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../util/img/logo.png" width="60" height="60">
      </div>
      <h1>COMPROBANTE DE PAGO</h1>';
      foreach ($empresa->objetos as $obj){
        $plantilla.='
          <div id="company" class="clearfix">
          <div id="negocio">'.$obj->nombre.'</div>
          <div>Direccion Numero ##, <br/>'.$obj->direccion.'</div>
          <div>Telefono: '.$obj->telefono.'</div>
          <div><a href="mailto:'.$obj->correo.'">'.$obj->correo.'</a></div>
          </div>';
      }
      foreach ($venta->objetos as $objeto){
        $plantilla.='
          <div id="project">
          <div><span>Codigo de Venta: </span>'.$objeto->id.'</div>
          <div><span>DNI: </span>'.$objeto->dni.'</div>
          <div><span>Cliente: </span>'.$objeto->cliente.'</div>
          <div><span>Fecha y Hora: </span>'.$objeto->fecha.'</div> 
          <div><span>Vendedor: </span>'.$objeto->vendedor.'</div>
          </div>';
      }
    $plantilla.='
      </header>
        <main>
          <table>
            <thead>
              <tr>
                <th class="service">Producto</th>
                <th class="service">Descripcion</th>
                <th class="service">Presentacion</th>
                <th class="service">Marca</th>
                <th class="service">Cantidad</th>
                <th class="service">Precio</th>
                <th class="service">Subtotal</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($venta_producto->objetos as $objeto) {
              $plantilla.='<tr>
                  <td class="servic">'.$objeto->producto.'</td>
                  <td class="servic">'.$objeto->descripcion.'</td> 
                  <td class="servic">'.$objeto->presentacion.'</td>
                  <td class="servic">'.$objeto->marca.'</td>
                  <td class="servic">'.$objeto->cantidad.'</td>
                  <td class="servic">'.$objeto->precio.'</td>
                  <td class="servic">'.$objeto->subtotal.'</td>
                </tr>';
            }
            $calculos = new Venta();
            $calculos-> obtener_id($id_venta);
            foreach ($calculos->objetos as $objeto) {
              $igv = $objeto->total* $obj->igv;
              $sub = $objeto->total-$igv;
              $plantilla.='
              <tr>
                <td colspan="8" class="grand total">SUBTOTAL</td>
                <td class="grand total">S/.'.$sub.'</td>
              </tr>
              <tr>
                <td colspan="8" class="grand total">IGV(18%)</td>
                <td class="grand total">S/'.$igv.'</td>
              </tr>
              <tr>
                <td colspan="8" class="grand total">TOTAL</td>
                <td class="grand total">S/'.$objeto->total.'</td>
              </tr>';
            }
            $plantilla.='
            </tbody>
          </table>
          <div id="notices">
            <div>Nota:</div>
            <div class="notice">*Presentar este comprobante de pago para cualquier reclamo o devolucion no procedera.</div>
            <div class="notice">*Revise su cambio antes de salir del establecimiento.</div>
          </div>
        </main>
          <footer>
            Creador MR (Miguel reyes sanchez) Ingeniero Software con Inteligencia Artificial.
          </footer>
      </body>';
    return $plantilla;
}
