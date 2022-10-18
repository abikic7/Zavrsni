<?php

class KlubController extends AutorizacijaController

{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'klub' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Klub::read()
        ]);
    }

    // public function novi()
    // {
    //     $noviKupac = Klub::create([
    //         'ime'=>'',
    //         'prezime'=>'',
    //         'email'=>''
    //     ]);
    //     header('location: ' . App::config('url') 
    //             . 'kupac/promjena/' . $noviKupac);
    // }
    
    public function promjena($sifra)
    {
        if(!isset($_POST['ime_kluba'])){

            $e = Klub::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'Klub');
            }

            $this->view->render($this->phtmlDir . 'detalji',[
                'e' => $e,
                'poruka' => 'Unesite podatke'
            ]);
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
    
        if($this->kontrola()){
            Klub::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'klub');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaIme_kluba() && $this->KontrolaStadion() ;
    }

    private function kontrolaIme_kluba()
    {
        if(strlen($this->entitet->ime_kluba)===0){
            $this->poruka = 'Ime kluba obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaStadion()
    {
        if(strlen($this->entitet->stadion)===0){
            $this->poruka = 'Ime stadiona obavezno';
            return false;
        }
        return true;
    }
}