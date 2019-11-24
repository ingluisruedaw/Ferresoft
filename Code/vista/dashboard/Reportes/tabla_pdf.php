<?php
require('fpdf/fpdf.php');
header("Content-Type: text/html;charset=UTF-8");  
class REPORTE extends FPDF
{
var $widths;
var $aligns;
var $titulo;
var $parametro;
var $paginar=true;// numero de pagina
var $piepag=true;//pie de pagina usuario y fecha
var $piedirec=false;//pára que aparezca la direccion o no del colegio con la pagina web
var $lineaencab=true;
//Funcion Que imprime el Encabezado  de página
function cabecera()
{

  
	    $empresa='Sistema de Información de Reportes';
	    $logo='http://10.0.10.229/~ferresoft/images/logo.png';
	    $direccion='Calle 59 No 59 - 65';
	    $telefono='3444333-ext 135';
	    $nit= '8009578-1';
	    $ciudad= 'Barranquilla Atlántico';
	 if($this->DefOrientation=='L') // si la orientacion es Horizontal
	   {
 	       $cordx=5;//para definir la coordena de donde sale el encabezado de los datos del colegio
	 	     $xfinal=265;// para el largo de la linea del encabezado
           }
	   else // si la orientacion es vertical
	   {
		
		  $cordx=10;
		  $xfinal=207;
	   }
	
     $w=array(20,40,40,40,20,20);
     //-----------------Imprime el Logo de la empresa-------------------
	 //-----------------Coordenadas Archivo, x,y,ancho,alto----------
     $this->Image($logo,15,7,50,24);
	
	//Movernos a la derecha
    $this->Cell($cordx);
    //-------Nombre del Colegio --------------------------
    $this->SetFont('Arial','B',10);
    $this->MultiCell(0,5,$empresa,0,'C');
     //Movernos a la derecha
    $this->Cell($cordx);
    
     //--------------Nit--------------------
     $this->SetFont('Arial','I',9);
     $this->MultiCell(0,5,'Nit: '.$nit,0,'C');
     //Movernos a la derecha
    $this->Cell($cordx);
    //--------------Telefonos--------------------
     $this->SetFont('Arial','I',9);
    // $this->MultiCell(0,5,'Teléfonos: '.$telefono,0,'C');
	  //Movernos a la derecha
    $this->Cell($cordx);
     //--------------------Nombre de la Ciudad-------------------
     $this->SetFont('Arial','B',9);
     $this->MultiCell(0,5,$ciudad,0,'C');
    $this->Ln();
     //$this->Ln();
     $this->Cell($cordx);
 if($this->piepag) // si esta activada  la linea en cabezado y pie de pagina
	  {
         if($this->lineaencab)// para que imprimi a o no la linea del encabezado
         {
		  //-------- adiciona el Titulo del Reporte----------------------
		 $this->Text(15,35,$this->titulo);
		//----------- Dibuja la linea superior------------------------
		$this->SetLineWidth(.3);
		$this->line(10,45,$xfinal,45);
		$this->SetLineWidth(.3);
		$this->Cell(30);
	  }
  }
 }// end cabecera
//------------- Función para el pie de página--------------------------
function piepagina()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    $y=$this->GetY()+3;
    //Arial italic 8
    $this->SetFont('Arial','I',7);
     //----------- Dibuja la linea Inferior-----------------------------
	  if($this->piepag) // si esta activada  la linea en cabezado y pie de pagina
	  {   
		$this->SetLineWidth(.3);
		$this->line(10,$y,200,$y);
	//--------------------- variables de impresion-----------------------	
		$usuario=$_REQUEST['idusuarioe'];
		 $empresa='Sistema de Información de Reportes';
	    $website='www.miempresa.com';
	    $direccion='Calle 59 No 59 - 65';
	    $telefono='3444333-ext 135';
	    $nit= '8009578-1';
	    $ciudad= 'Barranquilla Atlántico';

	//------------------------------------------------------------------	
		 //--------------Enumera las páginas parte ineferior-----------------
		$this->Text(15,$y+3,"Impreso por: ".$usuario." Fecha:  ".date("d/m/Y h:i:s A")." Sistema Web V1.0 ");
	  }
	  if($this->piedirec) // si esta activada  la linea encabezado y pie de pagina
	  {   
		$this->SetLineWidth(.3);
		$this->line(10,$y,200,$y);
		 //--------------Enumera las páginas parte ineferior-----------------
		 $pie=$direccion."   Página Web: ".$website."             Impreso por: ".$usuario;
		 $pie=$pie." Fecha:  ".date("d/m/Y h:i:s A")." Siga Web V1.0 Desarrollado por www.miempresa.com";
		$this->Text(15,$y+3,$pie);
	  }
       if($this->paginar) // si esta activada la paginacion   
       $this->Text(170,$y+3,"Página: ".$this->PageNo()." de {nb}");
    //-----------------------------------------------------------------
    
}
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}
function SetTitulo($t)
{
	//Set the Title Report
	$this->titulo=$t;
}
function SetPaginar($chk)
{
	//Set the Page Report
	$this->paginar=$chk;
}

function SetPiegina($chk)
{
	//Set the line en footer an head in the Report
	$this->piepag=$chk;
}


function SetPiedireccion($chk)
{
	//Set the line en footer an head in the Report
	$this->piedirec=$chk;
}
function Setlineencab($chk)
{
	//Set the line en footer an head in the Report
	$this->lineaencab=$chk;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}


function Row($data,$border=1,$alig='J',$fill=0,$altocelda=0)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
 	 $h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//-------------------Print the text-------------------
        if($altocelda==0)
     	  	$this->MultiCell($w,5,$data[$i],0,$a);
     	else	 
			$this->MultiCell($w,$altocelda,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function Fila($data,$border=1,$alig='J',$fill=0)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		//$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		//$this->Rect($x,$y,$w,$h);
		//-------------------Print the text-------------------
		$this->MultiCell($w,5,$data[$i],$border,$alig);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}
function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
}
?>