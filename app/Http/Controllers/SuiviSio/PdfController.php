<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use \App\Http\Controllers\fpdf\passfpdf;
use Anouar\Fpdf\Fpdf;
use Auth;
use App\Models\MainActivity;
use App\Models\Source;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function index()
    {
    	$user = Auth::user()->load('situations.activities');
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
		$pdf = new PassFpdf('L','mm','A3');
		$pdf->SetTitle(utf8_decode("Tableau de synthèse"));
		$pdf->SetAuthor('BTS SIO');
		$pdf->AddPage();
		$pdf->SetFont($police,'B',$potitre);

		$txt="BTS SERVICES INFORMATIQUES AUX ORGANISATIONS - TABLEAU DE SYNTHÈSE";
		$pdf->Cell(0,$hvt,utf8_decode($txt),0,1,"C");
		$pdf->SetFont($police,'B',$potexte);
		$txt="Nom et prénom du candidat : ".utf8_decode($user->last_name)." ".utf8_decode($user->first_name);
		$pdf->Cell(60, $hvt,"",0,0);
		$pdf->Cell(160,$hvt,utf8_decode($txt),0,0);
		$txt="Parcours : ".$user->group->course->name;
		$pdf->Cell(60,$hvt,$txt,0,0);
		$txt="Numéro du candidat : ";
		$pdf->Cell(0,$hvt,utf8_decode($txt),0,1);

		$pdf->SetFont($police,'B',$polibelle);
		$pdf->Ln(5);

		//situ oblig
		$pdf->Cell($mainActivities->count()*$lgoblig,$hvp,"Situation obligatoire",1,0,"C");
		//<>ajouté
		$y0=$pdf->getY();
		$x0=$pdf->getX();
		$pdf->MultiCell($mgs+$margeinterne,$hvp/2,utf8_decode("Situation professionnelle\n(intitulé et liste des documents et productions associés)"),0,"C");
		$pdf->SetXY($x0,$y0);
		//</ajouté>
		$pdf->Cell($mgs+$margeinterne,$hvp,"",0,0);
		//processus
		foreach($categories as $category)
		{
			$largeur=$lg*$category->activities->count();
			$pdf->Cell($largeur,$hvp,$category->nomenclature,1,0,"C");
		}

		//ecriture verticale pour activites
		$pdf->Ln($hvp);

		$x0=$offset;
		$x=$x0+$lgoblig/2;;
		$y0=$pdf->getY();
		$y1=$y0+$hv;//hauteur texte à 90°
		$pdf->SetFillColor($grisclairfond);
		foreach($mainActivities as $mainActivity){
			$pdf->TourneTexte(90,$x+$lg/2,$y1,utf8_decode("  ".$mainActivity->name));
		    $pdf->SetXY($x,$y0);
		  	$pdf->Cell($lg,$hv,"",1,0);//hauteur case verticale
		    $x+=$lg;
		}

		$x0=$mgs+4*$lgoblig+$margeinterne+$offset;
		$x=$x0+$lg/2;;
		$y0=$pdf->getY();
		$y1=$y0+$hv;

		$i = 0;
		foreach($categories as $category){
		  $lesact=$category->activities;
		  foreach ($lesact as $activity){
		  	$fill = ($i % 2 == 0);
		    $pdf->SetXY($x,$y0);
		    $pdf->Cell($lg,$hv,"",1,0,"C",$fill);
		  	$pdf->SetXY($x,$y0);

		  	$pdf->TourneTexte(90,$x+$lg/2,$y1,utf8_decode("  ".$activity->nomenclature."  ".str_limit($activity->label,57,'..')));
		  	$pdf->Cell($lg,$hv,"",1,0);//hauteur case verticale
		    $x+=$lg;
		    $i++;
		  }
		}
		$pdf->Ln($hv);
		foreach ($sources as $source)
		{
			if($user->situations()->where('source_id', $source->id)->count() > 0)
			{
				//affichage celules en filigranne
				$pdf->SetDrawColor($grisclairtrait);
				foreach ($mainActivities as $mainActivity) $pdf->Cell($lgoblig,$hvs,"","LR",0);
				$pdf->Cell($mgs+$margeinterne,$hvs,"",0,0);
				$ysrc=$pdf->getY();
				$xsrc=$pdf->getX();

				for ($i=0;$i<$userActivitiesCount ; $i++) $pdf->Cell($lg,$hvs,"","LR",0);//que gauche et droite en clair
				$pdf->SetXY($xsrc,$ysrc);
				$pdf->SetFont($police,'B',$potexte);
				//$pdf->Cell(0,$hvs,$leslibs[$src],0,1,"C");
				$pdf->Cell(0,$hvs,utf8_decode($source->description),0,1,"C");

				$pdf->SetDrawColor(0); //noir
				$pdf->SetFillColor($grisclairfond);
				foreach($user->situations->where('source_id', $source->id) as $situation){
				  // $typo=$situ["typo"];
				  $userActivities = $situation->getActivitiesId();
				  $pdf->SetFont($police,'B',$pocroix);
				  foreach ($mainActivities as $mainActivity)
				  {
				  	$activitiesId = $mainActivity->activities->pluck('id')->toArray();
				  	$check = (array_intersect($userActivities, $activitiesId)) ? " X" : " ";
				  	$pdf->Cell($lgoblig,$hvs,$check,1,0);
				  }
				  $pdf->Cell($margeinterne,$hvs,"",0,0);
				  $pdf->SetFont($police,'B',$polibelle);
				  $x0=$pdf->getX();
				  $y0=$pdf->getY();
				  $dts=$situation->begin_at.' - '.$situation->end_at;
				  $pdf->MultiCell($mgs,5,utf8_decode($situation->name)."\n".$dts,0);
				  $pdf->setXY($x0,$y0);
				  $pdf->Cell($mgs,$hvs,"",1,0);

				  //affichage des X pour les activites citées
				  $pdf->SetFont($police,'B',$pocroix);
				  $i = 0;
				foreach($categories as $category){
	            	foreach ($category->activities as $activity){
	            		$fill = ($i % 2 == 0);
	            		$check = (in_array($activity->id, $userActivities)) ? "X" : " ";
				  		$pdf->Cell($lg,$hvs,$check,1,0,"C",$fill);
				  		$i++;
					}
				}

				  $pdf->Ln($hvs);
				}
			}
		}
		$pdf->Ln(10);
		$pdf->SetFont($police,'B',$posousigne);
		$txtj=utf8_decode("Je soussigné-e");
		$pdf->Cell(80,$hvt,$txtj,0,0);
		$txt=utf8_decode("formatrice (formateur) au centre de formation");
		$pdf->Cell(120,$hvt,$txt,0,0);
		$txt=utf8_decode("certifie que le candidat (la candidate) a bien effectué en formation les activités et missions présentées dans ce tableau");
		$pdf->Cell(0,$hvt,$txt,0,1,"R");
		$pdf->output();
    }
}
