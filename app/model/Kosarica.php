<?php

class Kosarica
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from kosarica where sifra=:sifra
        
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
        
            select * from kosarica 
        
        ');
        $izraz->execute(); 
        return $izraz->fetchAll(); 
    }

    public static function create($kosarica)
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            insert into 
            kosarica(odjeca,ukupna_cijena_proizvoda,datum_isporuke,kolicina)
            values (:odjeca,:ukupna_cijena_proizvoda,:datum_isporuke,:kolicina);
        
        ');
        $izraz->execute($kosarica);
        return $veza->lastInsertId();
    }

    public static function update($kosarica)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            update kosarica set
                odjeca=:odjeca,
                ukupna_cijena_proizvoda=:ukupna_cijena_proizvoda,
                datum_isporuke=:datum_isporuke,
                kolicina=:kolicina
                    where sifra=:sifra
        
        ');
        $izraz->execute($kosarica);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            delete from kosarica where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
    }

}