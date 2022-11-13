<?php

class Nogometas
{



    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select b.ime_kluba, a.ime , a.prezime  
        from nogometas a left join klub b
        on a.klub =b.sifra 
        where a.sifra=:sifra
        
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
        
        select b.ime_kluba, a.ime , a.prezime  
        from nogometas a left join klub b
        on a.klub =b.sifra 
        group by b.ime_kluba,a.ime,a.prezime
        
        ');
        $izraz->execute(); 
        return $izraz->fetchAll(); 
    }

    public static function create($p) 
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        insert into nogometas (klub,ime,prezime)
        values (:klub,:ime,:prezime);
           
        ');
        $izraz->execute([
            'klub' => $p['klub'],
            'ime' => $p['ime'],
            'prezime' => $p['prezime']
            
        ]);

        return $veza->commit();
    }





    public static function update($p)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
            update nogometas set
            klub=:klub,
            ime=:ime,
            prezime=:prezima,
            where sifra=:sifra
            ');
            $izraz->execute($p);

    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        select nogometas from odjeca where sifra=:sifra
    ');
        $izraz->execute([
            'sifra' => $sifra
        ]);
        $sifraOdjeca = $izraz->fetchColumn();
        $izraz = $veza->prepare('
    delete from odjeca where sifra=:sifra
');
        $izraz->execute([
            'sifra' => $sifra
        ]);

        $izraz = $veza->prepare('
    delete from nogometas where sifra=:sifra
');
        $izraz->execute([
            'sifra' => $sifraOdjeca
        ]);

        $veza->commit();
    }

 
}