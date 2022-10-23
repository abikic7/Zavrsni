<?php

class Klub
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from klub where sifra=:sifra
        
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
        
        select * from klub order by ime_kluba
        
        ');
        $izraz->execute(); 
        return $izraz->fetchAll(); 
    }

     public static function create($klub)
     {

     $veza = DB::getInstance();
         $izraz = $veza->prepare('
        
             insert into 
             klub(ime_kluba,grad)
             values (:ime_kluba,:grad);
        
         ');
         $izraz->execute($klub);
         return $veza->lastInsertId();
     }

    public static function update($klub)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            update klub set
                ime_kluba=:ime_kluba,
                grad=:grad
                    where sifra=:sifra
        
        ');
        $izraz->execute($klub);
    }

     public static function delete($sifra)
     {
         $veza = DB::getInstance();
         $izraz = $veza->prepare('
        
             delete from klub where sifra=:sifra
        
         ');
         $izraz->execute([
             'sifra'=>$sifra
         ]);
     }

}