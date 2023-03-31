INSERT INTO prodotto (nome, descrizione, prezzo, id_categoria, quantita)
VALUES ('coca-cola','bibita fresca','4,5','1','10'),
('fanta','aranciata','4,5','1','5'),
('acqua naturale','simile','2','2','10');

INSERT INTO categoria (nome, descrizione)
VALUES ('bibite frizzanti','tante bollcine'),
('acque','le basi');

INSERT INTO ordine (data_ora,totale, id_cliente_esterno, nome_cliente, cognome_cliente, email_cliente, telefono_cliente, indirizzo_cliente, ritiro)
VALUES('2023/03/18 11:50:22','45,5','1','paolo','merlo','paolo.merlo@gmail.com','3407571178','Via Arginone 2','1');

INSERT INTO prodotti_ordine (id_prodotto, id_ordine)
VALUES('1','1'),('2','1'),('2','1');

INSERT INTO valore_nutrizionale (nome)
VALUES('Kcal'),('Fats'),('Proteins'),('Sugars');

INSERT INTO valori_nutrizionali_prodotto (id_valore_nutrizionale, id_prodotto, valore)
VALUES ('1','1','450'),('2','1','700');

INSERT INTO utente ( nome, cognome, email, password, telefono, data_nascita, active)
VALUES ('Blog','Neutral','neutral.blog@gmail.com', 'password1', '3468456845', '1998/03/11', '1'),
('William','Rossi','rossi.william@gmail.com', 'password2', '3466566845', '1996/05/21', '1'),
('Adrian','Pillington','pillington.adrian@gmail.com', 'password3', '34987856845', '2000/09/16', '1');

