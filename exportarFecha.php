<?php
$consulta = $_POST['consulta'];
$connect = mysqli_connect("localhost", "root", "", "ptglatin_base");
$sql = $consulta;
$result = mysqli_query($connect, $sql);
//Con estos Header se envia a imprimir el formato excel
//Si se colocan los header al final se muestra el formato html en pantalla
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
?>
<html>  
 <head>  
  <title>Export MySQL data to Excel in PHP</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 </head>  
 <body>  

   <div class="table-responsive">  
    <h2 align="left">Grupo PTG</h2>
    <h3 align="left">Inteligencia de Mercado</h3>
<!--
    <div style="text-align: center;">
      <form method="post" action="#">
       <input type="hidden" name="consulta" value="<?php echo $consulta; ?>">       
       <input type="submit" name="export" class="btn btn-success" value="Print" />
      </form>
-->
  </div>
  <br>


    <table class="table-sm table-bordered">
     <tr>  
       <th>Nombre</th>  
       <th>Apellido</th>
       <th>Fecha de Cumpleanos</th>
       <th>Aniversario</th>
       <th>Cargo</th>
       <th>Correo Electronico</th>
       <th>Empresa</th>
       <th>Tel. Trabajo</th>
       <th>Tel. Celular</th>
       <th>Direccion</th>
       <th>Pais</th>
       <th>Pais</th>
       <th>Sector</th>
       <th>Sector</th>
       <th>Cliente Prospecto</th>
       <th>Web Site</th>
       <th>Ejecutivo</th>
       <th>Linea de Negocio</th>
       <th>Productos</th>
       <th>Productos</th>
       <th>Monto de la Compra</th>
       <th>Fecha de Renovacion</th>
       <th>Fuente BD</th>
       <th>Numero de Empleados</th>
       <th>Grupo</th>
       <th>Grupo</th>
       <th>Genero</th>
       <th>Ciudad</th>
     </tr>

     <?php
     while($row = mysqli_fetch_array($result))  
     {  
        echo '  
       <tr>  
         <td>'.$row["cont_firstname"].'</td>  
         <td>'.$row["cont_lastname1"].'</td>
         <td>'.$row["cont_birthday"].'</td>
         <td>'.$row["aniversario"].'</td>
         <td>'.$row["cont_jobtitle"].'</td>
         <td>'.$row["cont_email"].'</td>
         <td>'.$row["cont_companyname"].'</td>
         <td>'.$row["cont_workphone"].'</td>
         <td>'.$row["cont_cellphone"].'</td>
         <td>'.$row["cont_addressline1"].'</td>
         <td>'.$row["cont_country"].'</td>
         <td>'.$row["pais"].'</td>
         <td>'.$row["cont_sector"].'</td>
         <td>'.$row["sector"].'</td>
         <td>'.$row["cliente_prospecto"].'</td>
         <td>'.$row["cont_website1"].'</td>
         <td>'.$row["ejecutivo"].'</td>
         <td>'.$row["linea_negocio"].'</td>
         <td>'.$row["cont_products"].'</td>
         <td>'.$row["producto"].'</td>
         <td>'.$row["monto_compra"].'</td>
         <td>'.$row["fecha_renovacion"].'</td>
         <td>'.$row["fuente_bd"].'</td>
         <td>'.$row["cont_employees"].'</td>         
         <td>'.$row["cont_group"].'</td>
         <td>'.$row["grupo"].'</td> 
         <td>'.$row["genero"].'</td>
         <td>'.$row["ciudad"].'</td>              
       </tr>  
        ';  
     }
     ?>
    </table>
  </div>  
 </body>  
</html>





<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "ptglatin_base");
$output = '';
if(isset($_POST["export"]))
{
 //$query = "SELECT * FROM users";
 $query = $consulta;
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
     <tr>  
       <th>Nombre</th>  
       <th>Apellido</th>
       <th>Fecha de Cumpleanos</th>
       <th>Aniversario</th>
       <th>Cargo</th>
       <th>Correo Electronico</th>
       <th>Empresa</th>
       <th>Tel. Trabajo</th>
       <th>Tel. Celular</th>
       <th>Direccion</th>
       <th>Pais</th>
       <th>Pais</th>
       <th>Sector</th>
       <th>Sector</th>
       <th>Cliente Prospecto</th>
       <th>Web Site</th>
       <th>Ejecutivo</th>
       <th>Linea de Negocio</th>
       <th>Productos</th>
       <th>Productos</th>
       <th>Monto de la Compra</th>
       <th>Fecha de Renovacion</th>
       <th>Fuente BD</th>
       <th>Numero de Empleados</th>       
       <th>Grupo</th>
       <th>Grupo</th>
       <th>Genero</th>
       <th>Ciudad</th>      
     </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
         <td>'.$row["cont_firstname"].'</td>     
         <td>'.$row["cont_lastname1"].'</td>
         <td>'.$row["cont_birthday"].'</td>
         <td>'.$row["aniversario"].'</td>
         <td>'.$row["cont_jobtitle"].'</td>
         <td>'.$row["cont_email"].'</td>
         <td>'.$row["cont_companyname"].'</td>
         <td>'.$row["cont_workphone"].'</td>
         <td>'.$row["cont_cellphone"].'</td>
         <td>'.$row["cont_addressline1"].'</td>
         <td>'.$row["cont_country"].'</td>
         <td>'.$row["pais"].'</td>
         <td>'.$row["cont_sector"].'</td>
         <td>'.$row["sector"].'</td>
         <td>'.$row["cliente_prospecto"].'</td>
         <td>'.$row["cont_website1"].'</td>
         <td>'.$row["ejecutivo"].'</td>
         <td>'.$row["linea_negocio"].'</td>
         <td>'.$row["cont_products"].'</td>
         <td>'.$row["producto"].'</td>
         <td>'.$row["monto_compra"].'</td>
         <td>'.$row["fecha_renovacion"].'</td>
         <td>'.$row["fuente_bd"].'</td>
         <td>'.$row["cont_employees"].'</td>         
         <td>'.$row["cont_group"].'</td>
         <td>'.$row["grupo"].'</td>
         <td>'.$row["genero"].'</td>
         <td>'.$row["ciudad"].'</td> 
      </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }
}
?>
