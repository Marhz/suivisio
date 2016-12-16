<style>
	* {
    	font-family: Helvetica;
	}
	.title{
		text-align: center;
		margin-bottom: 40px;
	}
	.m-left{
		margin-left: 150px;
	}
	h4{
		font-size: 18px;
	}
	.test{
		transform: rotate(270deg);
		/*transform-origin: left bottom 0;*/
		margin-top: 200px;
		display: inline-block;
		width:400px;
		overflow-x: hidden;
		border: 1px solid black;


	}
	.t{
		margin-left: -350px;		
	}
</style>

<h3 class="title">BTS SERVICES INFORMATIQUES AUX ORGANISATIONS - TABLEAU DE SYNTHESE</h3>
<h4 class="title">Nom et prénom du candidiat : {{Auth::user()->last_name}} {{Auth::user()->first_name}}
	<span class="m-left">Parcours : {{Auth::user()->group->course->name}}</span>
	<span class="m-left">Numéro du candidat : </span>
</h4>
<div class="test">1 ceci est un test frere re reefer fre ferfre ferf </div>
<div class="test t">2 ceci est un test frere re reefer fre ferfre ferf </div>
<div class="test t">3 ceci est un test frere re reefer fre ferfre ferf </div>
<div class="test t">4 ceci est un test frere re reefer fre ferfre ferf </div>
<div class="test t">5 ceci est un test frere re reefer fre ferfre ferf </div>