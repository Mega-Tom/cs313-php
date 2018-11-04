CREATE TABLE Player(
id SERIAL Primary Key,
Playername varchar(30) NOT NULL UNIQUE,
Password varchar(256) NOT NULL,
ranking int);

CREATE TABLE Request(
id SERIAL Primary Key,
challengerId int NOT NULL REFERENCES Player(id),
challengedId int NOT NULL REFERENCES Player(id));

CREATE TYPE GameState
   as enum ('no_setup','one_setup','two_setup','playing','one_won','two_won');

CREATE OR REPLACE FUNCTION invertState(inputState GameState) RETURNS GameState AS $$
    BEGIN
        RETURN (CASE inputState
            WHEN 'one_setup' THEN 'two_setup'
            WHEN 'two_setup' THEN 'one_setup'
            WHEN 'one_won'   THEN 'two_won'
            WHEN 'two_won'   THEN 'one_won'
            ELSE inputState END);
    END;
$$ LANGUAGE plpgsql;

CREATE TABLE Game(
id SERIAL Primary Key,
player1Id int NOT NULL REFERENCES Player(id),
player2Id int NOT NULL REFERENCES Player(id),
initalSetup int[80],
state GameState NOT NULL);

CREATE TABLE move(
id SERIAL Primary Key,
fromsqare int,
tosquare int,
seq int NOT NULL,
gameID int REFERENCES Game(id));

CREATE VIEW GameDouble AS
    SELECT id, player1Id, player2Id, state, bool 'no' AS fliped from game
    UNION
    SELECT id, player2ID, player1Id, invertState(state), bool 'yes' AS fliped from game;
    
