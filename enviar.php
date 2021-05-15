<?php
require("index.html");

//VARIABLES
$nombre =$_POST["nombre"];
$mail =$_POST["correo"];
$telefono =$_POST["telefono"];
$empresa =$_POST["mensaje"];

//BASE DE DATOS
$host="localhost";
$user="root";
$pass="";
$bd="emails";

$conn = mysqli_connect($host,$user,$pass,$bd);

$sql="INSERT INTO `email`(`nombre`, `correo`, `telefono`, `mensaje`) VALUES ('$nombre','$mail','$telefono','$empresa')";

if($conn->query($sql) === TRUE){ 
?>
<script>
	Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Se ha enviado su mensaje',
        showConfirmButton: false,
        timer: 1500
      });
</script>
<?php
}else{
?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Error al mandar el mensaje',
  text: 'Algo ha salido mal!'
});
</script>
<?php
}

mysqli_close($conn);


//ENVIAR EMAIL
$header = 'From: ' . $mail . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . ",\r\n";
$mensaje .= "Su e-mail es: " . $mail . " \r\n";
$mensaje .= "Su numero es: " . $telefono . " \r\n";
$mensaje .= "Mensaje: " . $empresa . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = 'cristaleriaelabra@gmail.com'; 

$asunto = 'Mensaje de mi sitio web';

mail($para, $asunto, utf8_decode($mensaje), $header);

//header("Location:index.html");
?>