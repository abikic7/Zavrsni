<?php

class KosaricaController extends AutorizacijaController

{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'kosarica' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Kosarica::read()
        ]);
    }

    public function novi()
    {
        $noviKosarica = Kosarica::create([
            'odjeca'=>'',
            'ukupna_cijena_proizvoda'=>'',
            'datum_isporuke'=>'',
            'kolicina'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'kosarica/promjena/' . $noviKosarica);
    }
    
    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $e = Kosarica::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'kosarica');
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
            Kosarica::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'kosarica');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaOdjeca() && $this->kontrolaUkupna_cijena_proizvoda()
        && $this->kontrolaDatum_isporuke()&& $this->kontrolaKolicina();
    }

    private function kontrolaOdjeca()
    {
        if(strlen($this->entitet->ime)===0){
            $this->poruka = 'Odjeća obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaUkupna_cijena_proizvoda()
    {
        if(strlen($this->entitet->prezime)===0){
            $this->poruka = 'Cijena obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaDatum_isporuke()
    {
        if(strlen($this->entitet->prezime)===0){
            $this->poruka = 'Datum obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaKolicina()
    {
        if(strlen($this->entitet->prezime)===0){
            $this->poruka = 'Količina obavezno';
            return false;
        }
        return true;
    }








    public function brisanje($sifra)
    {
        Kosarica::delete($sifra);
        header('location: ' . App::config('url') . 'kosarica');
    }

}