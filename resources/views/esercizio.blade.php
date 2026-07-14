<?php 

$puntiDiInteresse = [
        [
        "id" => 1,
        "nomePunto" => "Cattedrale di Santa Maria la Nova",
        "haIngressoGratuito" => true,
        "votoRecensioniSuCinque" => 4,
        ],
        [
        "id" => 2,
        "nomePunto" => "Castello di Pietrarossa",
        "haIngressoGratuito" => true,
        "votoRecensioniSuCinque" => 3,
        ],
        [
        "id" => 3,
        "nomePunto" => "Museo Archeologico di Marianopoli",
        "haIngressoGratuito" => false,
        "votoRecensioniSuCinque" => 4,
        ],
        [
        "id" => 4,
        "nomePunto" => "Stabilimento Averna (Amaro Siciliano)",
        "haIngressoGratuito" => false,
        "votoRecensioniSuCinque" => 5,
        ],


];


// echo $puntiDiInteresse[0]["nomePunto"]
  
$arraySoloNomi =[];

foreach($puntiDiInteresse as $museo){

echo $museo["nomePunto"];

$arraySoloNomi[]= $museo["nomePunto"];
}

dd($arraySoloNomi);

?>