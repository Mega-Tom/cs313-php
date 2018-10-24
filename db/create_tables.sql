CREATE TABLE Player(
id SERIAL Primary Key,
Playername varchar(30) NOT NULL UNIQUE,
Password varchar(20) NOT NULL,
ranking int);

CREATE TABLE Request(
id SERIAL Primary Key,
challengerId int REFERENCES Player(id),
challengedId int REFERENCES Player(id));

CREATE TABLE Game(
id SERIAL Primary Key,
player1Id int REFERENCES Player(id),
player2Id int REFERENCES Player(id),
initalSetup int[80],
winner BOOL);

CREATE TABLE "Move"(
id SERIAL Primary Key,
fromsqare int,
tosquare int,
seq int,
gameID int REFERENCES Game(id));

CREATE VIEW GameDouble AS
    SELECT id, player1Id, player2Id, bool 'n' AS fliped from game
    UNION
    SELECT id, player2ID, player1Id, bool 'y' AS fliped from game;
    
