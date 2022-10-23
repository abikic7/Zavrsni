<?php

$dev=$_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
    return [
        'dev'=>$dev,
        'url'=>'http://fanshop.hr/',
        'nazivApp'=>'fanshop App',
        'baza'=>[
            'server'=>'localhost',
            'baza'=>'zavrsni',
            'korisnik'=>'edunova',
            'lozinka'=>'edunova'
        ]
        ]; 
    
}else{
    // PRODUKCIJA
    return [
        'dev'=>$dev,
        'url'=>'https://polaznik07.edunova.hr/',
        'nazivApp'=>'Edunova App',
        'baza'=>[
            'server'=>'localhost',
            'baza'=>'hiperion_edunovapp25',
            'korisnik'=>'hiperion_edunova',
            'lozinka'=>'  '
        ]
    ];
}