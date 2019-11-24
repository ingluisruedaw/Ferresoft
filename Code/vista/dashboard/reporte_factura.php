<?php 
  if($_REQUEST['idfactura']==null || $_REQUEST['idusuarioe']==null){
      header('Location: http://10.0.10.229/~ferresoft/');
  }else{
  	require_once '../../modelo/Factura/Entidad.php';
    require_once '../../modelo/Factura/Modelo.php';
    $almFactura = new Factura();
    $modelFactura = new Factura_Model();
  }
  
?>
<?php
  require("Reportes/tabla_pdf.php");
  define("PDF_FONTPATH","fpdf/font/");
  header('Content-Type: text/html; charset=UTF-8');
  if (!isset($_SESSION)) session_start();
//.$datosFactura

foreach($modelFactura->ListarCompradorPDF($_REQUEST['idfactura']) as $r): 
	$_SESSION['cliente'] = $r->__GET('clientes_nombres');
	$_SESSION['vendedor'] = $r->__GET('empleados_nombres');
	$_SESSION['fecha'] = $r->__GET('fecha');
endforeach; 
class PDF extends REPORTE{
//Cabecera de página
   function Header(){

       $this->SetTitulo('Reporte Factura # '.$_REQUEST['idfactura']);
        $this->cabecera();
      //Salto de línea
       $this->Ln(12);
      $this->Tabla();
}
//Pie de página
 function Footer()
 {
   $this->piepagina();
 }//END Footer
function Tabla(){
      global $anyo,$curso,$asignatura,$periodo;

         //Colores, ancho de línea y fuente en negrita--- --->Color Blanco
            $this->SetFillColor(255,255,255);
            $this->SetTextColor(0);
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(.2);
            $this->SetFont('Arial','',9);
           //-------- adiciona el curso----------------------
            $cur=" ";
            $this->Text(10,39,$cur);
           //-------- adiciona el año y periodo-----------------
           $str="Fecha: ".$_SESSION['fecha'];
           $this->Text(160,43,$str);
           //-------------adiciona el Docente------------------
           $this->Text(75,43,"Vendedor: ".$_SESSION['vendedor']);
            //-------------adiciona la asignatura------------------
            $this->Text(10,43,"Cliente: ".$_SESSION['cliente']);
            //;;;;;;;;;;;;;;;;;;;Cabecera ancho del texto del encabezado de la tabla;;;;;;;;;;;
          //Títulos de las columnas
            $this->Ln(5);
           $cabecera=array('Embalaje','Descripcion','Iva','Precio','Cantidad', 'Total');
           //Tabla con N filas y 5  columnas
           $this->SetWidths(array(20, 80, 10, 20, 20, 40));
            $this->SetFont('Arial','B',10);
            for($i=0;$i<count($cabecera);$i++)
        	   $this->Cell($this->widths[$i],5,$cabecera[$i],1,0,'J',1);
        	$this->Ln();
   }//end Tabla
}//end class

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->Open();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
//Tabla con N filas y 2  columnas

$total = $modelFactura->BuscarTotalTemporal($_REQUEST['idfactura']);
  foreach($modelFactura->Listar_Detalle_Factura($_REQUEST['idfactura']) as $r): 
    $pdf->Row(array($r->__GET('embalaje_det'), $r->__GET('productos_nombre'), $r->__GET('iva_det'), number_format($r->__GET('precio_venta_neto')), $r->__GET('cantidad'),number_format($r->__GET('total'))));
    # code...
  endforeach; 
  $pdf->Row(array(' ', ' ', ' ',' ', 'Total: ',number_format($total)));
$pdf->Output();
?>