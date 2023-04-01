CREATE DATABASE bevande;

USE bevande;

CREATE TABLE prodotto(id int primary key auto_increment not null, nome nvarchar(25) not null,
descrizione nvarchar(50), prezzo decimal(4,2) not null, id_categoria int not null, quantita int not null, active bool not null);

CREATE TABLE categoria(id int primary key auto_increment not null,nome nvarchar(25) not null,
descrizione nvarchar(50) not null);

CREATE TABLE utente (id int primary key auto_increment not null,nome nvarchar(25) not null,
cognome nvarchar(30) not null, email nvarchar(30) not null, password nvarchar(15) not null,
telefono nvarchar(20) not null, data_nascita date not null, privilegi boolean not null, active boolean not null);

CREATE TABLE ordine (id int primary key auto_increment not null, data_ora datetime not null,
totale decimal (4,2) not null, id_cliente_esterno int NOT NULL, nome_cliente nvarchar(25) not null, cognome_cliente nvarchar(30) not null,
email_cliente nvarchar(30) not null, telefono_cliente nvarchar(20) not null, indirizzo_cliente nvarchar(50) not null,
ritiro bool not null);

CREATE TABLE prodotti_ordine(id_ordine int not null, id_prodotto int not null);

CREATE TABLE valore_nutrizionale(id int primary key auto_increment not null,nome nvarchar(25) not null);

CREATE TABLE valori_nutrizionali_prodotto ( id_valore_nutrizionale int not null, id_prodotto int not null, valore int not null);

ALTER TABLE prodotto ADD CONSTRAINT fk_id_categoria FOREIGN KEY (id_categoria) REFERENCES categoria(id);
ALTER TABLE prodotti_ordine ADD CONSTRAINT fk_id_prodotto2 FOREIGN KEY (id_prodotto) REFERENCES prodotto(id);
ALTER TABLE prodotti_ordine ADD CONSTRAINT fk_id_ordine FOREIGN KEY (id_ordine) REFERENCES ordine(id);
ALTER TABLE valori_nutrizionali_prodotto ADD CONSTRAINT fk_id_valore_nutrizionale FOREIGN KEY (id_valore_nutrizionale) REFERENCES valore_nutrizionale(id);
ALTER TABLE valori_nutrizionali_prodotto ADD CONSTRAINT fk_id_prodotto FOREIGN KEY (id_prodotto) REFERENCES prodotto(id);

INSERT INTO categoria (nome, descrizione)
VALUES ('bibite frizzanti','tante bollcine'),
('acque','le basi');

INSERT INTO prodotto (nome, descrizione, prezzo, id_categoria, quantita, active)
VALUES ('coca-cola','bibita fresca','4','1','10', true),
('fanta','aranciata','4',1,'5', true),
('acqua naturale','simile','2',2,'10', true);

INSERT INTO ordine (data_ora,totale, id_cliente_esterno, nome_cliente, cognome_cliente, email_cliente, telefono_cliente, indirizzo_cliente, ritiro)
VALUES('2023/03/18 11:50:22',45,'1','paolo','merlo','paolo.merlo@gmail.com','3407571178','Via Arginone 2','1');

INSERT INTO utente ( nome, cognome, email, password, telefono, data_nascita, active, privilegi)
VALUES ('Blog','Neutral','neutral.blog@gmail.com', 'password1', '3468456845', '1998/03/11', '1', '1'),
('William','Rossi','rossi.william@gmail.com', 'password2', '3466566845', '1996/05/21', '1', '1'),
('Adrian','Pillington','pillington.adrian@gmail.com', 'password3', '34987856845', '2000/09/16', '1', '1');

INSERT INTO prodotti_ordine (id_prodotto, id_ordine)
VALUES('1','1'),('2','1'),('2','1');

INSERT INTO valore_nutrizionale (nome)
VALUES('Kcal'),('Fats'),('Proteins'),('Sugars');

INSERT INTO valori_nutrizionali_prodotto (id_valore_nutrizionale, id_prodotto, valore)
VALUES ('1','1','450'),('2','1','700');