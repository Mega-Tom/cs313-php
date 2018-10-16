CREATE TABLE Player(
id SERIAL Primary Key,
Playername varchar(30),
ranking int);

CREATE TABLE Request(
id SERIAL Primary Key,
challengerId int REFERENCES Player(id),
challengedId int REFERENCES Player(id));

CREATE TABLE Game(
id SERIAL Primary Key,
player1Id int REFERENCES Player(id),
player2Id int REFERENCES Player(id),
initalSetup int[]);

CREATE TABLE Move(
id SERIAL Primary Key,
fromsqare int,
tosquare int,
seq int,
gameID int REFERENCES Game(id));

