<?php

class Odjeca
{

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select b.ime,b.prezime, a.velicina, a.boja, a.cijena, a.vrsta_proizvoda 
        from odjeca a inner join nogometas b
        on a.nogometas = b.sifra
        where a.sifra =:sifra
    
        
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
        
        select a.sifra,b.ime,b.prezime, a.velicina, a.boja, a.cijena, a.vrsta_proizvoda 
        from odjeca a inner join nogometas b
        on a.nogometas = b.sifra
        group by a.sifra,b.ime,b.prezime, a.velicina, a.boja, a.cijena, a.vrsta_proizvoda
        order by 4,3
        
        ');
        $izraz->execute(); 
        return $izraz->fetchAll(); 
    }

    public static function create($p) 
    {
        $veza = DB::getInstance();
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
    
        return $veza->lastInsertId();
         
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
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
    
       // return $veza->commit();
         
    }

    public static function dodajnogometas($nogometas)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           insert into odjeca(nogometas) values
           (:nogometas)
        
        ');
        $izraz->execute([
            'nogometas'=>$nogometas
        ]);
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
        $izraz->fetchColumn();
        
    }
    
}