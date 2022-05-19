# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8  < C:\Users\Bikan\Documents\Završni\zavrsni.sql

drop database if exists zavrsni;
create database zavrsni default charset utf8mb4;
use zavrsni;

create table kupac(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50)not null,
    broj_mobitela int,
    email varchar(100),
    ulica varchar(50),
    grad varchar(50),
    narudzba varchar(50),
    drzava varchar(50)

);

create table narudzba(
    sifra int not null primary key auto_increment,
    kupac varchar(50),
    status_narudzbe varchar(50),
    datum_isporuke datetime
);
 
create table naruceni_proizvodi(
    sifra int not null primary key auto_increment,
    proizvod varchar(50) not null,
    cijena decimal(18,2),
    poštarina decimal(18,2),
    dostava varchar(50),
    naziv_proizvoda varchar(50)
    
);

create table proizvodi(
    sifra int not null primary key auto_increment,
    naziv_proizvoda varchar(50),
    marka varchar(50),
    kategorija varchar(50),
    cijena decimal(18,2)
);

create table kategorija(
    sifra int not null primary key auto_increment,
    proizvod varchar(50),
    vrsta varchar(50)
);

 create table trgovina(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    broj_mobitela int,
    adresa varchar(50),
    email varchar(100)
 );
      
 alter table kategorija add foreign key (proizvodi) references proizvodi(sifra);  