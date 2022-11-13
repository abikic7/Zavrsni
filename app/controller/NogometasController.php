<?php

class NogometasController extends AutorizacijaController

{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'nogometas' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Nogometas::read()
        ]);
    }

    public function novi()
    {
        
        header('location: ' . App::config('url') 
                . 'nogometas/promjena/');
    }

    public function promjena($sifra = false)
    {
        {
            $klubovi = $this->ucitajKlubove();
            
            
    
            if (isset($_POST['nova']) && $_POST['nova'] === '1' ) {
                Klub::create($_POST);
                header('location: ' . App::config('url') . 'klub');
                return;
            }
    
            if(!$sifra){
                
                $this->detalji(false,$klubovi,'Unesite podatke');
                return;
            }
    
            $this->entitet = (object) $_POST;
            $this->entitet->sifra=$sifra;


            $entitet = Nogometas::readOne($sifra);

        if (!$entitet instanceof stdClass || $entitet->sifra != true) {
            header('location: ' . App::config('url') . 'nogometas');
        }

        if (isset($_POST['novi']) && $_POST['novi'] === '0' ) {
            $_POST['sifra'] = $sifra;
            Odjeca::update($_POST);
            header('location: ' . App::config('url') . 'nogometas');
            return;
        }
    

        $this->detalji($entitet,$klubovi,$this->poruka);
        }


        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
    
        if($this->kontrola()){
            Nogometas::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'nogometas');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]); 
        $this->detalji($this->entitet,$klubovi,$this->poruka);
    }


private function detalji($klubovi,$e,$poruka)
{
    $this->view->render($this->phtmlDir . 'detalji',[
        'e'=>$e,
        'klubovi'=>$klubovi,
        'poruka'=>$poruka
    ]);
} 

private function ucitajKlubove()
{
    $klubovi = [];
    $k = new stdClass();
    $k->sifra=0;
    $k->ime_kluba='Odaberi klub';
    $klubovi[]=$k;
    foreach(Klub::read() as $klub){
        $klubovi[]=$klub;
    }
    return $klubovi;
}



    private function kontrola()
    {
      return true;
    }


    
public function brisanje($sifra)
{
    Nogometas::delete($sifra);
    header('location: ' . App::config('url') . 'nogometas');
}



}