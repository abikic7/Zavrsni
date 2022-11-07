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
        $noviNogometas = Nogometas::create([   
            'klub'=>null,
            'ime'=>'',
            'prezime'=>''
            
        ]);
        header('location: ' . App::config('url') 
                . 'nogometas/promjena/' . $noviNogometas);
    }

    public function promjena($sifra)
    {
        $klub=$this->ucitajKlub();
       

        if(!isset($_POST['ime'])){

            $e = Nogometas::readOne($sifra);
            if($e==null){
                header('location: ' . App::config('url') . 'nogometas');
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
            Nogometas::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'igrac');
            return;
        }

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]); 
        $this->detalji($this->entitet,$klub,$this->poruka);
    }


private function detalji($klubovi,$e,$poruka)
{
    $this->view->render($this->phtmlDir . 'detalji',[
        'e'=>$e,
        'klubovi'=>$klubovi,
        'poruka'=>$poruka
    ]);
} 

private function ucitajKlub()
{
    $nba_teams = [];
    $n = new stdClass();
    $n->sifra=0;
    $n->naziv='Odaberi klub';
    $klubovi[]=$n;
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