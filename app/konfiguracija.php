<?php

$dev=$_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
    return [
        'dev'=>$dev,
        'url'=>'http://fanshop.hr/',
        'nazivApp'=>'DEV fanshop App',
        'baza'=>[
            'server'=>'localhost',
            'baza'=>'zavrsni',
            'korisnik'=>'edunova',
            'lozinka'=>'edunova'
        ]
        ]; 
    }
