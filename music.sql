DROP DATABASE IF EXISTS music;
CREATE DATABASE music;

USE music;

DROP TABLE IF EXISTS Artist;

CREATE TABLE Artist(
    ArtistID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Name varchar(255) NOT NULL,
    DateFormed DATE NOT NULL,
    DateEnded DATE,
    Genre varchar(255) NOT NULL,
    PRIMARY KEY(ArtistID)
);

DROP TABLE IF EXISTS Album;

CREATE TABLE Album(
    AlbumID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Name varchar(255) NOT NULL,
    ReleaseDate DATE NOT NULL,
    PRIMARY KEY(AlbumID)
);

DROP TABLE IF EXISTS ArtistAlbum;

CREATE TABLE ArtistAlbum(
    ArtistID SMALLINT UNSIGNED NOT NULL,
    AlbumID SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY(ArtistID, AlbumID),
    CONSTRAINT fk_albumid FOREIGN KEY (AlbumID) REFERENCES Album (AlbumID)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    CONSTRAINT fk_artistid FOREIGN KEY (ArtistID) REFERENCES Artist (ArtistID)
    ON UPDATE CASCADE
    ON DELETE CASCADE 
);

DROP TABLE IF EXISTS Song;

CREATE TABLE Song(
    SongID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    AlbumID SMALLINT UNSIGNED NOT NULL,
    Name varchar(255) NOT NULL,
    Length TIME NOT NULL,
    PRIMARY KEY (SongID),
    CONSTRAINT fk_albumsongid FOREIGN KEY (AlbumID) REFERENCES Album (AlbumID)
    ON UPDATE CASCADE
    ON DELETE CASCADE 
);

CREATE INDEX artist_name ON Artist (name);
CREATE INDEX album_name ON Album (name);
CREATE INDEX song_name ON Song (name);

DROP USER IF EXISTS 'php_user'@'localhost';

CREATE USER 'php_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON music.* TO 'php_user'@'localhost';

INSERT INTO Artist(Name, DateFormed, Genre) VALUES("Steely Dan", "1971-01-01", "Jazz Fusion, Yacht Rock");

INSERT INTO Album(Name, ReleaseDate) VALUES("Aja", "1977-09-23");
INSERT INTO Album(Name, ReleaseDate) VALUES("Gaucho", "1980-11-21"); 

INSERT INTO ArtistAlbum(ArtistID, AlbumID) VALUES((SELECT ArtistID from Artist WHERE Name = "Steely Dan"), (SELECT AlbumID from Album WHERE Name = "Aja"));
INSERT INTO ArtistAlbum(ArtistID, AlbumID) VALUES((SELECT ArtistID from Artist WHERE Name = "Steely Dan"), (SELECT AlbumID from Album WHERE Name = "Gaucho"));

INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "Black Cow", "5:10:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "Aja", "7:57:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "Deacon Blues", "7:33:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "Peg", "3:58:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "Home at Last", "5:34:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "I Got the News", "5:06:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Aja"), "Josie", "4:33:00");

INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "Babylon Sisters", "5:49:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "Hey Nineteen", "5:06:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "Glamour Profession", "7:29:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "Gaucho", "5:32:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "Time Out of Mind", "4:13:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "My Rival", "4:34:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Gaucho"), "Third World Man", "5:15:00");


INSERT INTO Artist(Name, DateFormed, Genre) VALUES("Kendrick Lamar", "2003-01-01", "Hip Hop, Rap");

INSERT INTO Album(Name, ReleaseDate) VALUES("Good Kid, M.A.A.D City", "2012-10-22");
INSERT INTO Album(Name, ReleaseDate) VALUES("To Pimp a Butterfly", "2015-03-15"); 

INSERT INTO ArtistAlbum(ArtistID, AlbumID) VALUES((SELECT ArtistID from Artist WHERE Name = "Kendrick Lamar"), (SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"));
INSERT INTO ArtistAlbum(ArtistID, AlbumID) VALUES((SELECT ArtistID from Artist WHERE Name = "Kendrick Lamar"), (SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"));

INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Sherane a.k.a Master Splinter's Daughter", "4:33:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "B****, Don't Kill My Vibe", "5:10:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Backseat Freestyle", "3:32:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "The Art of Peer Pressure", "5:24:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Money Trees", "6:26:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Poetic Justice", "5:00:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Good Kid", "3:34:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "M.A.A.D City", "5:50:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Swimming Pools (Drank)", "5:13:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Sing About Me, I'm Dying of Thirst", "12:03:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Real", "7:23:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "Good Kid, M.A.A.D City"), "Compton", "4:08:00");

INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Wesley's Theory", "4:47:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "King Kunta", "3:54:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Institutionalized", "4:31:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "These Walls", "5:00:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "U", "4:28:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Alright", "3:39:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Momma", "4:43:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Hood Politics", "4:52:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "How Much a Dollar Cost", "4:21:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Complexion", "4:23:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "The Blacker the Berry", "5:28:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "You Ain't Gotta Lie (Momma Said)", "4:01:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "I", "5:36:00");
INSERT INTO Song(AlbumID, Name, Length) VALUES((SELECT AlbumID from Album WHERE Name = "To Pimp a Butterfly"), "Mortal Man", "12:07:00");