<?php

$dev=$_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
    return [
        'dev'=>$dev,
        'url'=>'http://app.hr/',
        'nazivApp'=>'DEV Edunova App',
        'baza'=>[
            'server'=>'localhost',
            'baza'=>'edunovapp25',
            'korisnik'=>'edunova',
            'lozinka'=>'edunova'
        ]
        ]; 
    }
