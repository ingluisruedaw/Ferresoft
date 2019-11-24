
<?php
  require("Reportes/tabla_pdf.php");
  define("PDF_FONTPATH","fpdf/font/");
  header('Content-Type: text/html; charset=UTF-8');
class PDF extends REPORTE
{
//Cabecera de página
   function Header()
   {

       $this->SetTitulo('Reporte De Stock Existente');
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
function Tabla()
{
      global $anyo,$curso,$asignatura,$periodo;

         //Colores, ancho de línea y fuente en negrita--- --->Color Blanco
            $this->SetFillColor(255,255,255);
            $this->SetTextColor(0);
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(.2);
            $this->SetFont('Arial','',9);
           //-------- adiciona el curso----------------------
            $cur="Proyecto Pia";
            $this->Text(10,39,$cur);
           //-------- adiciona el año y periodo-----------------
           $str="Year: 2017";
           $this->Text(160,43,$str);
           //-------------adiciona el Docente------------------
           $this->Text(75,43,"Docente:  Enrique Martelo");
            //-------------adiciona la asignatura------------------
            $this->Text(10,43,"Asignatura:  Ingenieria Web");
            //;;;;;;;;;;;;;;;;;;;Cabecera ancho del texto del encabezado de la tabla;;;;;;;;;;;
          //Títulos de las columnas
            $this->Ln(5);
           $cabecera=array('Id','Categoria','Embalaje','Descripcion','Stock Existente',);
           //Tabla con N filas y 5  columnas
           $this->SetWidths(array(8, 40, 20, 90,30));
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

require_once '../../modelo/Producto/Entidad.php';
  require_once '../../modelo/Producto/Modelo.php';
  $almProductos = new Productos();
  $modelProductos = new Productos_Model();
  foreach($modelProductos->Listar_Activos() as $r): 
    $pdf->Row(array($r->__GET('id'), $r->__GET('categorias_det'), $r->__GET('embalaje_det'), $r->__GET('nombre'), $r->__GET('stockmin')));
    # code...
  endforeach; 
$pdf->Output();
?>