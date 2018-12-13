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
       <th>ID</th>  
       <th>Cod</th>  
       <th>Primer Nombre</th>  
       <th>Segundo Nombre</th>
       <th>Primer Apellido</th>
       <th>Segundo Apellido</th>
       <th>Fecha de Creacion</th>
       <th>Ultima Actualizacion</th>
       <th>Posicion</th>
       <th>Correo Electronico</th>
       <th>Empresa</th>
       <th>Tel. Trabajo</th>
       <th>Pais</th>
       <th>Ciudad</th>
       <th>Direccion</th>
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))  
     {  
        echo '  
       <tr>  
         <td>'.$row["cont_id"].'</td>  
         <td>'.$row["cont_code"].'</td>  
         <td>'.$row["cont_firstname"].'</td>  
         <td>'.$row["cont_middlename"].'</td>  
         <td>'.$row["cont_lastname1"].'</td>
         <td>'.$row["cont_lastname2"].'</td>
         <td>'.$row["cont_dateadded"].'</td>
         <td>'.$row["cont_lastupdate"].'</td>
         <td>'.$row["cont_jobtitle"].'</td>
         <td>'.$row["cont_email"].'</td>
         <td>'.$row["cont_companyname"].'</td>
         <td>'.$row["cont_workphone"].'</td>
         <td>'.$row["cont_country"].'</td>
         <td>'.$row["cont_city"].'</td>
         <td>'.$row["cont_addressline1"].'</td>
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
        <th>ID</th>  
       <th>Cod</th>  
       <th>Primer Nombre</th>  
       <th>Segundo Nombre</th>
       <th>Primer Apellido</th>
       <th>Segundo Apellido</th>
       <th>Fecha de Creacion</th>
       <th>Última Actualizacion</th>
       <th>Posicion</th>
       <th>Correo Electronico</th>
       <th>Empresa</th>
       <th>Tel. Trabajo</th>
       <th>Pais</th>
       <th>Ciudad</th>
       <th>Direccion</th>
     </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
      <td>'.$row["cont_id"].'</td>  
         <td>'.$row["cont_code"].'</td>  
         <td>'.$row["cont_firstname"].'</td>  
         <td>'.$row["cont_middlename"].'</td>  
         <td>'.$row["cont_lastname1"].'</td>
         <td>'.$row["cont_lastname2"].'</td>
         <td>'.$row["cont_dateadded"].'</td>
         <td>'.$row["cont_lastupdate"].'</td>
         <td>'.$row["cont_jobtitle"].'</td>
         <td>'.$row["cont_email"].'</td>
         <td>'.$row["cont_companyname"].'</td>
         <td>'.$row["cont_workphone"].'</td>
         <td>'.$row["cont_country"].'</td>
         <td>'.$row["cont_city"].'</td>
         <td>'.$row["cont_addressline1"].'</td>
      </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }
}
?>
