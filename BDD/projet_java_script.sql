DROP TABLE IF EXISTS Book;
DROP TABLE IF EXISTS Author;
DROP TABLE IF EXISTS IsWrite;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Own;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Belong;
DROP TABLE IF EXISTS Review;

---------------- CREATE TABLE

CREATE TABLE Book (
    idBook      integer auto_increment,
    title       varchar(500),
    resume      varchar(200),
    thumbnail   varchar(200),
    year        varchar(4),
    CONSTRAINT PK_BOOK PRIMARY KEY  (idBook)
) ;

CREATE TABLE Author (
    idAuthor    integer auto_increment,
    name    varchar(50),
    CONSTRAINT PK_AUTHOR PRIMARY KEY  (idAuthor)
) ;

CREATE TABLE IsWrite (
    idAuthor    integer,
    idBook      integer,
    CONSTRAINT PK_ISWRITE PRIMARY KEY  (idAuthor, idBook),
    CONSTRAINT FK_ISWRITE_AUTHOR FOREIGN KEY (idAuthor) REFERENCES Author(idAuthor),
    CONSTRAINT FK_ISWRITE_BOOK FOREIGN KEY (idBook) REFERENCES Book(idBook)
) ;

CREATE TABLE Utilisateur (
    idUser      integer auto_increment,
    username    varchar(50),
    lastname    varchar(50),
    firstname   varchar(50),
    password    varchar(50),
    CONSTRAINT PK_USER PRIMARY KEY  (idUser)
) ;

CREATE TABLE Own (
    idUser      integer,
    idBook      integer,
    CONSTRAINT PK_OWN PRIMARY KEY  (idUser, idBook),
    CONSTRAINT FK_OWN_USER FOREIGN KEY (idUser) REFERENCES Utilisateur(idUser),
    CONSTRAINT FK_OWN_BOOK FOREIGN KEY (idBook) REFERENCES Book(idBook)
) ;

CREATE TABLE Genre (
    idGenre      integer auto_increment,
    libele       varchar(50),
    CONSTRAINT PK_GENRE PRIMARY KEY  (idGenre)
) ;

CREATE TABLE Belong (
    idBook      integer,
    idGenre     integer,
    CONSTRAINT PK_BELONG PRIMARY KEY  (idGenre, idBook),
    CONSTRAINT FK_BELONG_BOOK FOREIGN KEY (idBook) REFERENCES Book(idBook),
    CONSTRAINT FK_BELONG_GENRE FOREIGN KEY (idGenre) REFERENCES Genre(idGenre)
) ;

CREATE TABLE Review (
    idReview      integer auto_increment,
    note          int,
    descr         varchar(200),
    idBook        int,
    idUser        int,
    CONSTRAINT PK_REVIEW PRIMARY KEY  (idReview),
    CONSTRAINT FK_REVIEW_BOOK FOREIGN KEY (idBook) REFERENCES Book(idBook),
    CONSTRAINT FK_REVIEW_USER FOREIGN KEY (idUser) REFERENCES Utilisateur(idUser)
) ;

---------------- FOREIGN KEY

ALTER TABLE IsWrite ADD FOREIGN KEY (idAuthor) REFERENCES Author(idAuthor);

ALTER TABLE IsWrite ADD FOREIGN KEY (idBook) REFERENCES Book(idBook);

ALTER TABLE Own ADD FOREIGN KEY (idUser) REFERENCES Utilisateur(idUser);

ALTER TABLE Own ADD FOREIGN KEY (idBook) REFERENCES Book(idBook);

ALTER TABLE Belong ADD FOREIGN KEY (idBook) REFERENCES Book(idBook);

ALTER TABLE Belong ADD FOREIGN KEY (idGenre) REFERENCES Genre(idGenre);

ALTER TABLE Review ADD FOREIGN KEY (idBook) REFERENCES Book(IdBook);

ALTER TABLE Review ADD FOREIGN KEY (idUser) REFERENCES Utilisateur(IdUser);

