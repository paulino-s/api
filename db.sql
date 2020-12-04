


CREATE TABLE PRODUCTO(
	codpro int not null AUTO_INCREMENT,
	nompro varchar(50) null,
	despro varchar(100) null,
	prepro decimal(6,2) null,
	estado int null, 
	CONSTRAINT pk_producto
	PRIMARY KEY (codpro)
)character set latin1 collate latin1_spanish_ci;

alter table PRODUCTO add rutimapro varchar(100) null;

INSERT INTO PRODUCTO (nompro,despro,prepro,estado,rutimapro)
VALUES ('Motherboard','Motherboard mini ATX','74.99',1,'gest1.jpg')
,('Papel Bond A4','Tarjeta gráfica de última generación, juega al máximo y disfruta con tus amigos','999.99',1,'gest2.jpg')
,('CPM AMD ryzen 3 3600X','Leva tus juegos al máximo rendiemiento','249.99',1,'gest3.jpg');