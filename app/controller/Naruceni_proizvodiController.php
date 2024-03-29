<?php

class Naruceni_proizvodiController extends AutorizacijaController
{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'naruceni_proizvodi' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Naruceni_proizvodi::read()
        ]);
    }

    public function novi()
    {
        $noviNaruceni_proizvodi = Naruceni_proizvodi::create([   
            'ime'=>'',
            'prezime'=>'',
            'email'=>'',
            'ukupna_cijena_proizvoda'=>'',
            'datum_isporuke'=>''
            
        ]);
        header('location: ' . App::config('url') 
                . 'naruceni_proizvodi/promjena/' . $noviNaruceni_proizvodi);
    }

    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $e = Naruceni_proizvodi::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'naruceni_proizvodi');
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
            Naruceni_proizvodi::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'naruceni_proizvodi');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }
    


    private function kontrola()
    {
     
    }

    public function brisanje($sifra)
    {
        Naruceni_proizvodi::delete($sifra);
        header('location: ' . App::config('url') . 'naruceni_proizvodi');
    }
}