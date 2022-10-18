# 
# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 <C:\Users\Bikan\Desktop\Završni\Zavrsni\zavrsni.sql

drop database if exists zavrsni;
create database zavrsni default charset utf8mb4;
use zavrsni;

create table operater(
    sifra int not null primary key auto_increment,
    email varchar(50) not null,
    lozinka varchar(100) not null,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    uloga varchar(20) not null
);


create table kupac(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50)not null,
    broj_mobitela int,
    email varchar(100),
    ulica varchar(50),
    grad varchar(50),
    drzava varchar(50)

);

create table košarica(
    sifra int not null primary key auto_increment,
    kupac int,
    status_narudzbe varchar(50),
    datum_isporuke datetime,
    naruceni_proizvodi int not null
    
);
 
create table naruceni_proizvodi(
    sifra int not null primary key auto_increment,
    proizvodi int not null,
    cijena decimal(18,2),
    poštarina decimal(18,2),
    dostava varchar(50),
    naziv_proizvoda varchar(50)
    
    
);

create table proizvodi(
    sifra int not null primary key auto_increment,
    naziv_proizvoda varchar(50),
    marka varchar(50),
    cijena decimal(18,2)
);

create table kategorija(
    sifra int not null primary key auto_increment,
    proizvodi int not null,
    vrsta varchar(50)
);

 create table trgovina(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    broj_mobitela int,
    adresa varchar(50),
    email varchar(100),
    narudzba int 
 );
      
 alter table košarica add foreign key (kupac) references kupac(sifra);
  alter table košarica add foreign key (naruceni_proizvodi) references naruceni_proizvodi(sifra);
  alter table trgovina add foreign key (košarica) references košarica(sifra);  
   alter table naruceni_proizvodi add foreign key (proizvodi) references proizvodi(sifra);  
    alter table kategorija add foreign key (proizvodi) references proizvodi(sifra);

insert into kupac(sifra,ime,prezime,broj_mobitela,email,ulica,grad,drzava)
values (null,'Ivan','Ivanušec',0982321232,'ivani@gmail.com','KraljaTomislava','Đakovo','Hrvatska'),
 (null,'Mario','Ivušić',0932921252,'marioi@gmail.com','Frankopanska','Đakovo','Hrvatska'),
 (null,'Leon','Stanušec',091235788,'leon@gmail.com','Vukovarska','osijek','Hrvatska'),
 (null,'Petar','Sušić',097666777,'peros@gmail.com','Divaltova','Osijek','Hrvatska'),
 (null,'Krešimir','Drogba',09823227232,'kredro@gmail.com','Omladinska','Viškovci','Hrvatska'),
 (null,'Stjepan','Petković',0992229932,'stjep@gmail.com','KraljaTomislava','Viškovci','Hrvatska');

 # admin a, oper o
insert into operater(email,lozinka,ime,prezime,uloga)
values
('admin@edunova.hr','$2a$12$QtSIcQh6FDW04CBBpuO68Oms8RwMAeVSjHgj1zOeR1.T6oMIdvbkS',
    'Edunova','Administrator','admin'),
('oper@edunova.hr','$2a$12$MIDZvMIUSNjaqTWLCYb9VuBcRttF.74Ehqbh9xBYrKQryFN68QTcO',
    'Edunova', 'Operater','oper');


insert into košarica(sifra,kupac,status_narudzbe,datum_isporuke,naruceni_proizvodi);
values


insert into naruceni_proizvodi(sifra,proizvodi,cijena,poštarina,dostava,naziv_proizvoda)
values(1,1,1,1,1,1 );

