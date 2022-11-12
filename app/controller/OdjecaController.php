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

        header('location: ' . App::config('url') . 'odjeca/promjena/');
       
    }
    
    public function promjena($sifra)
    {
        $nogometasi = $this->ucitajNogometase();
        
        

        if (isset($_POST['novi']) && $_POST['novi'] === '1' ) {
            Nogometas::create($_POST);
            header('location: ' . App::config('url') . 'nogometas');
            return;
        }

        if(!$sifra){
            //prazna forma
            $this->detalji(false,$nogometasi,'Unesite podatke');
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
        
        
    
        $entitet = Odjeca::readOne($sifra);

        if (!$entitet instanceof stdClass || $entitet->sifra != true) {
            header('location: ' . App::config('url') . 'odjeca');
        }

        if (isset($_POST['novi']) && $_POST['nov'] === '0' ) {
            $_POST['sifra'] = $sifra;
            Odjeca::update($_POST);
            header('location: ' . App::config('url') . 'odjeca');
            return;
        }
    

        $this->detalji($entitet,$nogometasi,$this->poruka);
    }

    private function detalji($e,$nogometasi,$poruka)
    {
        $this->view->render($this->phtmlDir . 'detalji', [
            'e'=>$e,
            'nogometasi'=>$nogometasi,
            'poruka'=>$poruka,
            
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