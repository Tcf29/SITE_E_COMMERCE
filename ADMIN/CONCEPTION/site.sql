DROP DATABASE IF EXISTS ECOMMERCE;
CREATE DATABASE ECOMMERCE;
use ECOMMERCE;
create table `user`(
    id_user int not null auto_increment,
    nom varchar(30) not null,
    email varchar(30) not null,
    `password` varchar(70) not null,
    `status` varchar(15) not null,
    zone_livraison_livreur varchar(50) not null,
    disponibilite varchar(40) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (id_user)
);
create table role(
    id_role int not null auto_increment,
    nom varchar(15) not null,
    primary key (id_role)
);

create table role_user(
    id_role_user int not null auto_increment,
    id_user int not null,
    id_role int not null,
    primary key (id_role_user),
    foreign key (id_user) references user(id_user),
    foreign key (id_role) references role(id_role)
);

create table commande(
    id_commande int not null auto_increment,
    id_user int not null,
    prix_commande float not null,
    `status` varchar(25) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key (id_commande),
    foreign key (id_user) references user(id_user)
);

create table paiement(
    id_paiement int not null auto_increment,
    id_commande int not null,
    mode_paiement varchar(50) null,
    `status_paiement` varchar(15) not null, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (id_paiement),
    foreign key (id_commande) references commande(id_commande)
);


create table livraison(
    id_livraison int not null auto_increment,
    id_user int null,
    id_commande int not null,  
    nom varchar(30) not null,
    email varchar(30) not null,
    telephone int not null,
    zone_livraison_commande varchar(30) not null,
    adresse_livraison_commande varchar(30) not null,
    frais_livraison float not null,
    status_livraison varchar(20) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key (id_livraison),
    foreign key (id_user) references user(id_user),
    foreign key (id_commande) references commande(id_commande)
);

create table categorie(
    id_categorie int not null auto_increment,
    nom varchar(50) not null,
    primary key (id_categorie)
);
create table sous_categorie(
    id_sous_categorie int not null auto_increment,
    id_categorie int not null,
    nom varchar(80) not null,
    primary key (id_sous_categorie),
    foreign key (id_categorie) references categorie(id_categorie)
);

create table produit(
    id_produit int not null auto_increment,
    id_sous_categorie int not null,
    nom varchar(30) not null,
    prix_produit float not null,
    `photo` varchar(50) not null,
    status varchar(15) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key (id_produit),
    foreign key (id_sous_categorie) references sous_categorie(id_sous_categorie)
);


create table detail_produit_commande(
    id_detail_produit_commande int not null auto_increment,
    id_commande int not null,
    id_produit int not null,
    quantite int not null,
    primary key (id_detail_produit_commande),
    foreign key (id_commande) references commande(id_commande),
    foreign key (id_produit) references produit(id_produit)
);

create table mouvement_stock(
    id_mouvement_stock int not null auto_increment,
    id_produit int not null,
    type_mouvement varchar(30) not null,
    quantite int not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key (id_mouvement_stock),
    foreign key (id_produit) references produit(id_produit)
);

create table stock(
    id_stock int not null auto_increment,
    id_produit int not null,
    stock_disponible int not null,
    primary key (id_stock),
    foreign key (id_produit) references produit(id_produit)
);
   INSERT INTO categorie(nom)
VALUES ("INFORMATIQUE"),
       ("TELEPHONES ET ACCESSOIRES"),
       ("TELEVISIONS ET AUDIO"),
       ("ELECTROMENAGERS");

   INSERT INTO sous_categorie(id_categorie,nom)
VALUES (1,"LAPTOPS"),
        (1,"PERIPHERIQUES"),
        (2,"SMARTPHONES"),
        (2,"ACCESSOIRES"),
        (3,"TV LED"),
        (3,"AUDIO"),
         (4,"REFRIGERATEURS"),
          (4,"VENTILLATEURS");
       
INSERT INTO role (nom)
VALUES ("CLIENT"),
       ("LIVREUR"),
       ("ADMINISTRATEUR");