CREATE TABLE kayttajatiedot (
    kid int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ktun varchar(30),
    ksal varchar(100)
    );

CREATE TABLE yksityistiedot (
    kid int UNSIGNED AUTO_INCREMENT,
    kika int(120),
    ksukupuoli ENUM('F', 'M'),
    kpituus DECIMAL(4,1),
    kmitta DECIMAL(3,1),
	FOREIGN KEY (kid) REFERENCES kayttajatiedot(kid));

INSERT INTO kayttajatiedot VALUES (1, 'Pasiviheraho', '$2a$12$8Lvx87/pJixFeO/qjFbRpOyhr2v0Ingu8x9iS/QSqRLAUJ08J6Kca'); /* salasana: makkara */
INSERT INTO kayttajatiedot VALUES (2, 'Lissu', '$2a$12$6YNfZul37c808MmwmHtO3O0uxTegnlGA0LKy8hXm0Uq8MYqebnTGy');

INSERT INTO yksityistiedot VALUES (1, 60, 'M', 180.2, 20.5);
INSERT INTO yksityistiedot VALUES (2, 25, 'F', 170.5, NULL);