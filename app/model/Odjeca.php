<?php

class Odjeca
{

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from odjeca
        where 
        sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        return $izraz->fetch(); 
    }

   
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from odjeca  
        
        ');
        $izraz->execute(); 
        return $izraz->fetchAll(); 
    }

    public static function create($p) 
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        insert into odjeca (velicina,boja,nogometas,cijena,vrsta_proizvoda)
        values (:velicina,:boja,:nogometas,:cijena,:vrsta_proizvoda);
           
        ');
        $izraz->execute([
            'velicina'=>$p['velicina'],
            'boja'=>$p['boja'],
            'nogometas'=>$p['nogometas'],
            'cijena'=>$p['cijena'],
            'vrsta_proizvoda'=>$p['vrsta_proizvoda']
        ]);
    
        return $veza->commit();
         
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        update odjeca set
        velicina=:velicina,
        boja=:boja,
        nogometas=:nogometas,
        cijena=:cijena,
        vrsta_proizvoda=:vrsta_proizvoda,
        where sifra=:sifra
    ');
    $izraz->execute([
        'velicina'=>$p['velicina'],
        'boja'=>$p['boja'],
        'cijena'=>$p['cijena'],
        'vrsta_proizvoda'=>$p['vrsta_proizvoda']
    ]);
    
        return $veza->commit();
         
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           delete from odjeca where sifra=:sifra 
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        
    }
    
}