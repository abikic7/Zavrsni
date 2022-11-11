<?php

class OdjecaController extends AutorizacijaController

{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'odjeca' .
        DIRECTORY_SEPARATOR;
    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Odjeca::read()
        ]);
    }

    public function novi()
    {


        $noviOdjeca = Odjeca::create([ 
            'velicina'=>'',
            'boja'=>'',
            'nogometas'=>1,
            'cijena'=>'',
            'vrsta_proizvoda'=>''

        ]);
        header('location: ' . App::config('url') 
                . 'odjeca/promjena/' . $noviOdjeca);
    }
    
    public function promjena($sifra)
    {

        $nogometase = $this->ucitajNogometase();
        if(!isset($_POST['ime'])){

            $e = Odjeca::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'odjeca');
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
            Odjeca::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'odjeca');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka,
            'nogometase'=>$nogometase
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaVelicina() && $this->kontrolaBoja();
    }

    private function kontrolaVelicina()
    {
        if(strlen($this->entitet->velicina)===0){
            $this->poruka = 'Velicina obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaBoja()
    {
        if(strlen($this->entitet->boja)===0){
            $this->poruka = 'Boja obavezno';
            return false;
        }
        return true;
    }

    public function brisanje($sifra)
    {
        Odjeca::delete($sifra);
        header('location: ' . App::config('url') . 'odjeca');
    }

    private function ucitajNogometase()
    {
        $nogometasi = [];
        $n = new stdClass();
        $n->sifra=0;
        $n->ime='Odaberi';
        $n->prezime='Nogometaša';
        $nogometasi[]=$n;
        foreach(Nogometas::read() as $nogometas){
            $nogometasi[]=$nogometas;
        }
        return $nogometasi;
    }

}