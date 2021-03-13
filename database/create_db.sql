drop database if exists magazin_procedural;
create database if not exists magazin_procedural;

	use magazin_procedural;

/* CREATION DES TABLES DANS NOTRE BASE DES DONNEES */

	create table categories(idCategorie int(5) primary key auto_increment, nomCategorie varchar(255) not null);


		create table familles(idFamille int(5) primary key auto_increment, nomFamille varchar(255), idCategorie int(5));



			create table produits(idProduit int(5) primary key auto_increment, nomProduit varchar(255) not null, prixProduit int(15) not null, photoProduit varchar(255) not null, idCategorie int(5), idFamille int(5));


				create table utilisateurs(idUser int(5) primary key auto_increment, login varchar (255) not null, email varchar (255) not null, roles varchar(255) not null, password varchar(255) not null, photoUtilisateur varchar(255) not null, actif int(5));


/*PRECISION DES CLES ETRANGERES*/

Alter table familles add constraint foreign key(idCategorie) references categories(idCategorie);

Alter table produits add constraint foreign key(idCategorie) references categories(idCategorie);

Alter table produits add constraint foreign key(idFamille) references familles(idFamille); 


/* INSERTION DES DONNEES PAR DEFAUT POUR LES TESTS DE CONCEPTION */


insert into categories(nomCategorie) VALUES 
	('Produits Alimentaires'),
	('Produits Cosmétiques'),
	('Produits Electroniques'),
	('Produits De beauté'),
	('Produits De Style'),
	('Produits De conserve'),
	('Produits De Soins'),
	('Produits Pour Bébé'),
	('Produits Pour Adultes'),
	('Produits Pour Ingénieurs'),
	('Produits de Quincaillerie'),
	('Produits de mannequin'),
	('Produits de Guerre'),
	('Produits de Pharmacie'),
	('Produits de Papéterie'),
	('Produits de Contrat');

	SELECT * FROM categories;



insert into familles(nomFamille, idCategorie) VALUES 
	('légumes', 1),
	('fruits', 1),
	('Appareils informatiques', 3),
	('Appareils Electroniques', 3),
	('Habits pour bébé', 8), 
	('Jouets pour Bébé', 8),
	('Elements de protection pour adultes', 9),
	('Armes de pointe', 13),
	('Médicaments Cosmétiques', 2),
	('Outils Ingénieurs', 10), ('Outils pour Elèves', 15),
	('Outils Mannequins', 12),
	('Outils de soins', 7); 

	SELECT * FROM familles;


insert into produits (nomProduit, prixProduit, photoProduit, idCategorie, idFamille) VALUES
	('Choux', 1, 'choux.jpg', 1, 2),
	('Téléphone', 100, 'telephone.jpg', 3,4),
	('Ordinateur', 500, 'ordinateur.jpg', 10,10),
	('Culotte Bébé', 2, 'culotte.jpg', 8, 5),
	('Cahier', 1, 'cahier.jpg', 15, 11),
	('Clavier', 25, 'clavier.jpg', 10, 10),
	('Relvover', 400, 'revolver.jpg', 13, 8),
	('Shampoo', 18, 'Shampoo.jpg', 4, 12),
	('Pomme de terre', 2, 'pomme_de_terre.jpg', 1, 1),
	('Ampoule', 4, 'ampoule.jpg', 3, 4),
	('Cachenez', 3, 'cachenez.jpg', 9,7),
	('Robe', 89, 'robe.jpg', 4, 12);

	SELECT * FROM produits;


insert into utilisateurs(login, email, roles, password, photoUtilisateur, actif) VALUES
('utilisateur1', 'usernumeroun@gmail.com', 'ROLE_CLIENT', md5('passworduser123'),'utilisateur1.jpg',1) ,
('administrateur', 'utilisateurtesttwo@gmail.com', 'ROLE_ADMIN', md5('passworduser123'),'administrateur.jpg', 1),
('user3', 'user3@gmail.com', 'ROLE_CLIENT', md5('1234'),'user3.jpg', 0),
('user4', 'user4@gmail.com', 'ROLE_CLIENT', md5('0000'), 'user4.jpg',0),
('gerant1', 'jehdailegrand12@gmail.com', 'ROLE_GERANT', md5('12345'),'gerant1.jpg', 1),
('jerome', 'jerome@gmail.com', 'ROLE_CLIENT', md5('1212'), 'jerome.jpg', 1),
('jean', 'jean@gmail.com', 'ROLE_CLIENT', md5('1111'), 'jean.jpg', 0),
('Bruno', 'bruno@gmail.com', 'ROLE_CLIENT', md5('1212'),'jean.jpg',1),
('prisca', 'prisca@gmail.com', 'ROLE_CLIENT', md5('1111'), 'prisca.jpg', 1),
('young', 'youn@gmail.com', 'ROLE_CLIENT', md5('1212'), 'young.jpg', 0),
('rush', 'rush@gmail.com', 'ROLE_CLIENT', md5('1111'),'rush.jpg', 1),
('olga', 'olga@gmail.com', 'ROLE_CLIENT', md5('1212'),'olga.jpg',0),
('brigitte', 'brigitte@gmail.com', 'ROLE_CLIENT', md5('1111'), 'brigitte.jpg', 0);


   SELECT * FROM utilisateurs;


   /* MODIFICATION , AJOUT DE LA TABLE ROLE ET SUPPRESSION DE ROLE DANS utilisateurs  */

   create table roles(idRole int (5) primary key auto_increment, nomRole varchar(255) not null);

   	/* INSERTION DES ROLES dans la table roles */

   	insert into roles(nomRole) VALUES
   		('Client Simple'),
   		('Administrateur'),
   		('Agent gestionnaire');

   		/* Faire le lien entre la table utilisateurs et roles, après avoir la colonne idRole dans utilisaturs sur graphique */
        

        Alter table utilisateurs add constraint foreign key(idRole) references roles(idRole);






  

