# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Bikan\Desktop\Zavrsni\fanshop.hr\zavrsni.sql

# davanje ovlasti korisnik edunova lozinka edunova
#grant all privileges
#on zavrsni.*
#to 'edunova'@'localhost'
#identified by 'edunova';



#drop database if exists zavrsni;
#create database zavrsni default charset utf8mb4;
#use zavrsni;

alter database hiperion_zavrsni  character set utf8mb4;

create table operater(
    sifra int not null primary key auto_increment,
    email varchar(50) not null,
    lozinka varchar(100) not null,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    uloga varchar(20) not null
);
# admin a, oper o
insert into operater(email,lozinka,ime,prezime,uloga)
values
('admin@edunova.hr','$2a$12$QtSIcQh6FDW04CBBpuO68Oms8RwMAeVSjHgj1zOeR1.T6oMIdvbkS',
    'Edunova','Administrator','admin'),
('oper@edunova.hr','$2a$12$MIDZvMIUSNjaqTWLCYb9VuBcRttF.74Ehqbh9xBYrKQryFN68QTcO',
    'Edunova', 'Operater','oper');


create table klub(
    sifra int not null primary key auto_increment,
    ime_kluba varchar(50),
    grad varchar(50)
);

create table nogometas(
    sifra int not null primary key auto_increment,
    klub int not null,
    ime varchar(50) ,
    prezime varchar(50)
);

    
create table kupac(
    sifra int not null primary key auto_increment,
    ime varchar(50)not null, 
    prezime varchar(50)not null,
    email varchar(50)not null
);

create table odjeca (
    sifra int not null primary key auto_increment,
    velicina varchar(50),
    boja varchar(50),
    nogometas int,
    cijena decimal(18,2),
    vrsta_proizvoda varchar(50)  
);

create table naruceni_proizvodi (
    sifra int not null primary key auto_increment,
    kosarica int,
    kupac int  
);

    
create table kosarica(
    sifra int not null primary key auto_increment,
    odjeca int ,
    ukupna_cijena_proizvoda decimal(18,2),
    datum_isporuke datetime,
    kolicina int
);

 
alter table nogometas add foreign key (klub) references klub(sifra);
alter table kosarica add foreign key (odjeca) references odjeca(sifra);
alter table naruceni_proizvodi add foreign key (kosarica) references kosarica(sifra);
alter table naruceni_proizvodi add foreign key (kupac) references kupac(sifra);
alter table odjeca add foreign key (nogometas) references nogometas(sifra);

insert into klub (sifra, ime_kluba,grad)
 values (null,'GNK Dinamo Zagreb','Zagreb'),                  
        (null,'HNK Hajduk Split', 'Split'),             
        (null,'NK Osijek', 'Osijek'), 
        (null,'HNK Gorica', 'Velika Gorica'), 
        (null,'NK Istra', 'Pula'), 
        (null,'HNK Rijeka', 'Rijeka'),
        (null,'NK Lokomotiva', 'Gorica'), 
        (null,'HNK Šibenik', 'Šibenik'), 
        (null,'NK Slaven-Belupo', 'Koprivnica'), 
        (null,'NK Varaždin', 'Varteks');



    insert into nogometas ( sifra, ime, prezime, klub)
        values           
        (null,'Bruno', 'Petković', 1 ),
        (null,'Mislav', 'Oršić', 1 ),
        (null,'Arijan', 'Ademi', 1 ),
        (null,'Dominik', 'Livaković', 1 ),
        (null,'Marko', 'Livaja', 2 ),
        (null,'Lovre', 'Kalinić', 2 ),
        (null,'Stipe', 'Biuk', 2 ),
        (null,'Nikola', 'Kalinić', 2 ),
        (null,'Ivica', 'Ivušić', 3 ),
        (null,'Mile', 'Škorić', 3 ),
        (null,'Laslo', 'Kleinheishler', 3 ),
        (null,'Josip', 'Mitrović', 4 ),
        (null,'Toni', 'Fruk', 4 ),
        (null,'Deni', 'Jurić', 4 ),
        (null,'Lovro', 'Majkić', 5 ),
        (null,'Luka', 'Bradarić', 5 ),
        (null,'Luka', 'Marin', 5 ),
        (null,'Nediljko', 'Labrović', 6 ),
        (null,'Matej', 'Mitrović', 6 ),
        (null,'Mario', 'Vrančić', 6 ),
        (null,'Nikola', 'Čavlina', 7 ),
        (null,'Josip', 'Pivarić', 7 ),
        (null,'Ibrahim', 'Aliyu', 7 ),
        (null,'Lovre', 'Logić', 8 ),
        (null,'Mislav', 'Matić', 8 ),
        (null,'Josip', 'Kvesić', 8 ),
        (null,'Duje', 'Čop', 8 ),
        (null,'Antun', 'Marković', 9 ),
        (null,'Vinko', 'Soldo', 9 ),
        (null,'Ivan', 'Krstanović', 9 ),
        (null,'Marino', 'Bulat', 10 ),
        (null,'Filip', 'Brekalo', 10 ),
        (null,'Fran', 'Brodić', 10 );


insert into odjeca (sifra,vrsta_proizvoda,nogometas, boja,velicina, cijena )
values 
(null,'Dres', 1, 'Plavi', 'XL', 699.99),
 (null,'Dres', 1, 'Plavi', 'M', 699.99),
 (null,'Dres', 1, 'Plavi', 'L', 699.99),
 (null,'Dres', 1, 'Plavi', 'S', 699.99),
 (null,'Dres', 2, 'Bijeli', 'M', 599.99),
 (null,'Dres', 2, 'Bijeli', 'XL', 599.99),
 (null,'Dres', 2, 'Bijeli', 'S', 599.99),
 (null,'Dres', 2, 'Bijeli', 'L', 599.99),
 (null,'Dres', 3, 'Bijelo-plavi', 'M', 599.99),
 (null,'Dres', 3, 'Bijelo-plavi', 'L', 599.99),
(null,'Dres', 3, 'Bijelo-plavi', 'S', 599.99),
 (null,'Dres', 3, 'Bijelo-plavi', 'XL', 599.99),
 (null,'Dres', 4, 'Crveni', 'L', 549.99),
 (null,'Dres', 4, 'Crveni', 'XL', 549.99),
 (null,'Dres', 4, 'Crveni', 'S', 549.99),
 (null,'Dres', 4, 'Crveni', 'M', 549.99),
 (null,'Dres', 5, 'Žuti', 'XL', 549.99),
 (null,'Dres', 5, 'Žuti', 'M', 549.99),
 (null,'Dres', 5, 'Žuti', 'S', 549.99),
 (null,'Dres', 5, 'Žuti', 'L', 549.99),
 (null,'Dres', 6, 'Bijeli', 'L', 249.99),
 (null,'Dres', 6, 'Bijeli', 'M', 249.99),
 (null,'Dres', 6, 'Bijeli', 'S', 249.99),
 (null,'Dres', 6, 'Bijeli', 'XL', 249.99),
 (null,'Dres', 7, 'Crno-bijeli', 'L', 209.99),
 (null,'Dres', 7, 'Crno-bijeli', 'XL', 209.99),
 (null,'Dres', 7, 'Crno-bijeli', 'M', 209.99),
 (null,'Dres', 7, 'Crno-bijeli', 'S', 209.99),
 (null,'Dres', 8, 'Narančasti', 'S', 509.99),
 (null,'Dres', 8, 'Narančasti', 'M', 509.99),
 (null,'Dres', 8, 'Narančasti', 'L', 509.99),
 (null,'Dres', 8, 'Narančasti', 'XL', 509.99),
 (null,'Dres', 9, 'Crni', 'XL', 429.99),
 (null,'Dres', 9, 'Crni', 'L', 429.99),
 (null,'Dres', 9, 'Crni', 'M', 429.99),
 (null,'Dres', 9, 'Crni', 'S', 429.99),
 (null,'Dres', 10, 'Bijelo-plavi', 'S', 178.99),
 (null,'Dres', 10, 'Bijelo-plavi', 'M', 178.99),
 (null,'Dres', 10, 'Bijelo-plavi', 'L', 178.99),
 (null,'Dres', 10, 'Bijelo-plavi', 'XL', 178.99),
 (null,'Hlačice', 1, 'Plavi', 'XL', 299.99),
 (null,'Hlačice', 1, 'Plavi', 'M', 299.99),
 (null,'Hlačice', 1, 'Plavi', 'L', 299.99),
 (null,'Hlačice', 1, 'Plavi', 'S', 299.99),
 (null,'Hlačice', 2, 'Bijeli', 'M', 199.99),
 (null,'Hlačice', 2, 'Bijeli', 'XL', 199.99),
 (null,'Hlačice', 2, 'Bijeli', 'S', 199.99),
 (null,'Hlačice', 2, 'Bijeli', 'L', 199.99),
 (null,'Hlačice', 3, 'Bijelo-plavi', 'M', 199.99),
 (null,'Hlačice', 3, 'Bijelo-plavi', 'L', 199.99),
(null,'Hlačice', 3, 'Bijelo-plavi', 'S', 199.99),
 (null,'Hlačice', 3, 'Bijelo-plavi', 'XL', 199.99),
 (null,'Hlačice', 4, 'Crveni', 'L', 349.99),
 (null,'Hlačice', 4, 'Crveni', 'XL', 349.99),
 (null,'Hlačice', 4, 'Crveni', 'S', 349.99),
 (null,'Hlačice', 4, 'Crveni', 'M', 349.99),
 (null,'Hlačice', 5, 'Žuti', 'XL', 49.99),
 (null,'Hlačice', 5, 'Žuti', 'M', 49.99),
 (null,'Hlačice', 5, 'Žuti', 'S', 49.99),
 (null,'Hlačice', 5, 'Žuti', 'L', 49.99),
 (null,'Hlačice', 6, 'Bijeli', 'L', 249.99),
 (null,'Hlačice', 6, 'Bijeli', 'M', 249.99),
 (null,'Hlačice', 6, 'Bijeli', 'S', 249.99),
 (null,'Hlačice', 6, 'Bijeli', 'XL', 249.99),
 (null,'Hlačice', 7, 'Crno-bijeli', 'L', 109.99),
 (null,'Hlačice', 7, 'Crno-bijeli', 'XL', 109.99),
 (null,'Hlačice', 7, 'Crno-bijeli', 'M', 109.99),
 (null,'Hlačice', 7, 'Crno-bijeli', 'S', 109.99),
 (null,'Hlačice', 8, 'Narančasti', 'S', 209.99),
 (null,'Hlačice', 8, 'Narančasti', 'M', 209.99),
 (null,'Hlačice', 8, 'Narančasti', 'L', 209.99),
 (null,'Hlačice', 8, 'Narančasti', 'XL', 209.99),
 (null,'Hlačice', 9, 'Crni', 'XL', 129.99),
 (null,'Hlačice', 9, 'Crni', 'L', 129.99),
 (null,'Hlačice', 9, 'Crni', 'M', 129.99),
 (null,'Hlačice', 9, 'Crni', 'S', 129.99),
 (null,'Hlačice', 10, 'Bijelo-plavi', 'S', 78.99),
 (null,'Hlačice', 10, 'Bijelo-plavi', 'M', 78.99),
 (null,'Hlačice', 10, 'Bijelo-plavi', 'L', 78.99),
 (null,'Hlačice', 10, 'Bijelo-plavi', 'XL', 78.99);

 insert into kosarica(sifra,odjeca, ukupna_cijena_proizvoda, datum_isporuke, kolicina)
values(null,1,699.99,"2022-10-18 15:27:30",2);


 insert into kupac(sifra,ime, prezime,email)
values 
(null,'Ante','Bikić','bikic.tm@gmail.com'),
 (null,'Mario','Ivušić','marioi@gmail.com'),
 (null,'Leon','Stanušec','leon@gmail.com'),
 (null,'Petar','Sušić','peros@gmail.com'),
 (null,'Krešimir','Drogba','kredro@gmail.com'),
 (null,'Stjepan','Petković','stjep@gmail.com');

                  
insert into naruceni_proizvodi(sifra,kosarica ,kupac)
values(1,1,1);