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
        $novi = Kosarica::create([   
            'odjeca'=>1,
            'ukupna_cijena_proizvoda'=>'',
            'datum_isporuke'=>'', 
            'kolicina'=>''           
        ]);
        header('location: ' . App::config('url') 
                . 'kosarica/promjena/' . $novi);
    }

    public function promjena($sifra)
    {
        $odjece=$this->ucitajOdjece();
       

        if(!isset($_POST['cijena'])){
            $e = Kosarica::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'kosarica');
            }
           
            $this->view->render($this->phtmlDir . 'detalji',[
                'e' => $e,
                'odjece'=>$odjece,
                'poruka' => 'Unesite podatke'
            ]);
            
            return;
        }
        

        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
      
        
             Kosarica::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'kosarica');
            
            return
        

        $this->detalji($this->entitet,$odjece,$this->poruka);
    }


private function detalji($e,$odjece,$poruka)
{
    $this->view->render($this->phtmlDir . 'detalji',[
        'e'=>$e,
        'odjece'=>$odjece,
        'poruka'=>$poruka
    ]);
} 

private function ucitajOdjece()
{
    $odjece = [];
    $n = new stdClass();
    $n->sifra=0;
    $n->cijena='cijena';
    $n->boja='boja';
    $n->velicina='velicina';
    $n->vrsta_proizvoda='vrsta proizvoda';
    $odjece[]=$n;
    foreach(Odjeca::read() as $odjeca){
        $odjece[]=$odjece;
    }
    return $odjece;
}



  

public function brisanje($sifra)
{
    Kosarica::delete($sifra);
    header('location: ' . App::config('url') . 'kosarica');
}



}