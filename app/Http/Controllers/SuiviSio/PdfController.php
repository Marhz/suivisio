<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use \App\Http\Controllers\fpdf\passfpdf;
use Anouar\Fpdf\Fpdf;
use Auth;
use User;
use App\Models\MainActivity;
use App\Models\Source;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    private $pdf;

    public function index(Request $request, $user_id)
    {
    	$user = User::find($user_id)->load('situations.activities');
      if (Auth::user()->can('viewPDF', $user))
      {
          $this->getBilanPdf($user);
          $this->pdf->output();
      }
      else
        return redirect()->back();
    }

    public function group(Request $request, $group_id)
    {
      $group = \App\Models\Group::find($group_id)->load('users.situations.activities');
      if (Auth::user()->can('viewPDF', $group))
      {
        foreach($group->users as $user)
          $this->getBilanPdf($user);
        $this->pdf->output();
      }
      else
        return redirect()->back();
    }

    private function getBilanPdf($user)
    {
    	$categories = $user->group->course->getCategories();
    	$mainActivities = MainActivity::with('activities')->get();
    	$sources = Source::all();
    	$userActivitiesCount = 0;
    	foreach($categories as $category)
    	{
    		$userActivitiesCount += $category->activities->count();
    	}
    	$margeg=10; //marge gauche
  		$hvt=15; //hauteur texte
  		$hvp=15; //hauteur ligne processus
  		$hv=60;//hauteur texte écrit verticalement;
  		$hvs=15;//hauteur pour une situ, fixe puisque seul libcourt<=64car
  		$margeinterne=4;//marge entre 4 col. oblig et les 57 autres ( 1 <= $margeinterne <= 6)
  		$lg=6;
  		$lgoblig=6;
  		$offset=7;
  		$mgs=32;//largeur colonne de gauche pour situs (libcourt)
  		//en points :
  		$potitre=14;
  		$potexte=12;
  		$pocroix=10;
  		$posousigne=10;
  		$polibelle=5;
  		//niveau de gris
  		$grisclairfond=200;
  		$grisclairtrait=200;

  		$police="Arial";

      if($this->pdf == null)
        $this->pdf = new PassFpdf('L','mm','A3');

    	$this->pdf->SetTitle(utf8_decode("Tableau de synthèse"));
  		$this->pdf->SetAuthor('BTS SIO');
  		$this->pdf->AddPage();
  		$this->pdf->SetFont($police,'B',$potitre);

  		$txt="BTS SERVICES INFORMATIQUES AUX ORGANISATIONS - TABLEAU DE SYNTHÈSE";
  		$this->pdf->Cell(0,$hvt,utf8_decode($txt),0,1,"C");
  		$this->pdf->SetFont($police,'B',$potexte);
  		$txt="Nom et prénom du candidat : ".utf8_decode($user->last_name)." ".utf8_decode($user->first_name);
  		$this->pdf->Cell(60, $hvt,"",0,0);
  		$this->pdf->Cell(160,$hvt,utf8_decode($txt),0,0);
  		$txt="Parcours : ".$user->group->course->name;
  		$this->pdf->Cell(60,$hvt,utf8_decode($txt),0,0);
  		$txt="Numéro du candidat : ".$user->numeroCandidat;
  		$this->pdf->Cell(0,$hvt,utf8_decode($txt),0,1);

  		$this->pdf->SetFont($police,'B',$polibelle);
  		$this->pdf->Ln(5);

  		//situ oblig
  		$this->pdf->Cell($mainActivities->count()*$lgoblig,$hvp,"Situation obligatoire",1,0,"C");
  		//<>ajouté
  		$y0=$this->pdf->getY();
  		$x0=$this->pdf->getX();
  		$this->pdf->MultiCell($mgs+$margeinterne,$hvp/2,utf8_decode("Situation professionnelle\n(intitulé et liste des documents et productions associés)"),0,"C");
  		$this->pdf->SetXY($x0,$y0);
  		//</ajouté>
  		$this->pdf->Cell($mgs+$margeinterne,$hvp,"",0,0);
  		//processus
  		foreach($categories as $category)
  		{
  			$largeur=$lg*$category->activities->count();
  			$this->pdf->Cell($largeur,$hvp,$category->nomenclature,1,0,"C");
  		}

  		//ecriture verticale pour activites
  		$this->pdf->Ln($hvp);

  		$x0=$offset;
  		$x=$x0+$lgoblig/2;;
  		$y0=$this->pdf->getY();
  		$y1=$y0+$hv;//hauteur texte à 90°
  		$this->pdf->SetFillColor($grisclairfond);
  		foreach($mainActivities as $mainActivity){
  			$this->pdf->TourneTexte(90,$x+$lg/2,$y1,utf8_decode("  ".$mainActivity->name));
  		    $this->pdf->SetXY($x,$y0);
  		  	$this->pdf->Cell($lg,$hv,"",1,0);//hauteur case verticale
  		    $x+=$lg;
  		}

  		$x0=$mgs+4*$lgoblig+$margeinterne+$offset;
  		$x=$x0+$lg/2;;
  		$y0=$this->pdf->getY();
  		$y1=$y0+$hv;

  		$i = 0;
  		foreach($categories as $category){
  		  $lesact=$category->activities;
  		  foreach ($lesact as $activity){
  		  	$fill = ($i % 2 == 0);
  		    $this->pdf->SetXY($x,$y0);
  		    $this->pdf->Cell($lg,$hv,"",1,0,"C",$fill);
  		  	$this->pdf->SetXY($x,$y0);

  		  	$this->pdf->TourneTexte(90,$x+$lg/2,$y1,utf8_decode("  ".$activity->nomenclature."  ".str_limit($activity->label,57,'..')));
  		  	$this->pdf->Cell($lg,$hv,"",1,0);//hauteur case verticale
  		    $x+=$lg;
  		    $i++;
  		  }
  		}
  		$this->pdf->Ln($hv);
  		foreach ($sources as $source)
  		{
  			if($user->situations()->where('source_id', $source->id)->count() > 0)
  			{
  				//affichage celules en filigranne
  				$this->pdf->SetDrawColor($grisclairtrait);
  				foreach ($mainActivities as $mainActivity) $this->pdf->Cell($lgoblig,$hvs,"","LR",0);
  				$this->pdf->Cell($mgs+$margeinterne,$hvs,"",0,0);
  				$ysrc=$this->pdf->getY();
  				$xsrc=$this->pdf->getX();

  				for ($i=0;$i<$userActivitiesCount ; $i++) $this->pdf->Cell($lg,$hvs,"","LR",0);//que gauche et droite en clair
  				$this->pdf->SetXY($xsrc,$ysrc);
  				$this->pdf->SetFont($police,'B',$potexte);
  				//$this->pdf->Cell(0,$hvs,$leslibs[$src],0,1,"C");
  				$this->pdf->Cell(0,$hvs,utf8_decode($source->description),0,1,"C");

  				$this->pdf->SetDrawColor(0); //noir
  				$this->pdf->SetFillColor($grisclairfond);
  				foreach($user->situations->where('source_id', $source->id) as $situation){
  				  // $typo=$situ["typo"];
  				  $userActivities = $situation->getActivitiesId();
  				  $this->pdf->SetFont($police,'B',$pocroix);
  				  foreach ($mainActivities as $mainActivity)
  				  {
  				  	$activitiesId = $mainActivity->activities->pluck('id')->toArray();
  				  	$check = (array_intersect($userActivities, $activitiesId)) ? " X" : " ";
  				  	$this->pdf->Cell($lgoblig,$hvs,$check,1,0);
  				  }
  				  $this->pdf->Cell($margeinterne,$hvs,"",0,0);
  				  $this->pdf->SetFont($police,'B',$polibelle);
  				  $x0=$this->pdf->getX();
  				  $y0=$this->pdf->getY();
  				  $dts=$situation->begin_at.' - '.$situation->end_at;
  				  $this->pdf->MultiCell($mgs,5,utf8_decode($situation->name)."\n".$dts,0);
  				  $this->pdf->setXY($x0,$y0);
  				  $this->pdf->Cell($mgs,$hvs,"",1,0);

  				  //affichage des X pour les activites citées
  				  $this->pdf->SetFont($police,'B',$pocroix);
  				  $i = 0;
  				foreach($categories as $category){
  	            	foreach ($category->activities as $activity){
  	            		$fill = ($i % 2 == 0);
  	            		$check = (in_array($activity->id, $userActivities)) ? "X" : " ";
  				  		$this->pdf->Cell($lg,$hvs,$check,1,0,"C",$fill);
  				  		$i++;
  					}
  				}

  				  $this->pdf->Ln($hvs);
  				}
  			}
  		}
  		$this->pdf->Ln(10);
  		$this->pdf->SetFont($police,'B',$posousigne);
  		$txtj=utf8_decode("Je soussigné-e");
  		$this->pdf->Cell(80,$hvt,$txtj,0,0);
  		$txt=utf8_decode("formatrice (formateur) au centre de formation");
  		$this->pdf->Cell(120,$hvt,$txt,0,0);
  		$txt=utf8_decode("certifie que le candidat (la candidate) a bien effectué en formation les activités et missions présentées dans ce tableau");
  		$this->pdf->Cell(0,$hvt,$txt,0,1,"R");
      //$this->pdf->output();
    }
}
