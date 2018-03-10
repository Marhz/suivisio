<?php
namespace App\Http\Controllers\fpdf;
use Anouar\Fpdf\Fpdf;

class PassFPDF extends FPDF
{

  var $angle=0;
  var $x;
  var $y;

  function CellRadio($wt,$wr,$h,$txt,$typ,$border,$valide,$por)
  {
    $b1="";
    $b2="";
    $ln=0;
    if ($typ=="B") $this->SetGras($por); else $this->SetPasGras($por);
    if (strstr($border,"L")) {$b1.="L";}
    if (strstr($border,"T")) {$b1.="T"; $b2.="T";}
    if (strstr($border,"B")) {$b1.="B"; $b2.="B";}
    if (strstr($border,"R")) { $b2.="R"; $ln=1;}
    if ($valide=="O") $v="l"; else $v="m";
    $this->Cell($wt,$h,$txt,$b1,0,"R");
    $this->SetFont('zapfdingbats','',10);
    $this->Cell($wr,$h,$v,$b2,$ln,"L");
    $this->SetPasGras($por);
  }

  function Puce($numero,$position,$taille, $police)
  {
    $puces="à+-";
    $txt=substr($puces,$numero,1);
    //$txt="+";
    $this->SetFont('zapfdingbats','',16);
    $this->Cell($position,7,$txt,0,0,"R");
    $this->SetFont($police,'',$taille);
  }

  function SetGras($p){
    $this->SetFont('Arial','B',$p);
  }

  function SetPasGras($p){
    $this->SetFont('Arial','',$p);
  }

  function Header()
  {
    //$this->Image("images/logoFiligrane.png",120,10,70);
    //$this->Image("images/bandeau.png",30,7,15);
  }

  function Footer()
  {
      //Pied de page
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->SetTextColor(128);
      //$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
  }

  function Rotate($angle,$x=-1,$y=-1){
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
  }

  function TourneTexte($angle=90,$x,$y,$txt){
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
  }
}
?>
