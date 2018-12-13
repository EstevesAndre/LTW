.mode columns
.header on
.nullvalue NULL

PRAGMA foreign_keys = ON;

-- Table: Channel
DROP TABLE IF EXISTS Channel;

CREATE TABLE Channel (
    id INTEGER PRIMARY KEY,
    cType VARCHAR NOT NULL
);

-- Table: UserLikesChannel
DROP TABLE IF EXISTS UserLikesChannel;

CREATE TABLE UserLikesChannel (
    id_Channel INTEGER REFERENCES Channel(id),
    username_user VARCHAR REFERENCES User(username)
);

-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    username VARCHAR PRIMARY KEY,
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    name VARCHAR,
    surname VARCHAR,
    genre VARCHAR,
    age INTEGER,
    points INTEGER
);

-- Table: Publication
DROP TABLE IF EXISTS Publication;

CREATE TABLE Publication (
    id INTEGER PRIMARY KEY,
    username VARCHAR REFERENCES User,
    timestamp DATETIME CHECK (timestamp > 0), -- date when this was published
    tags VARCHAR NOT NULL, -- comma separated tags
    title VARCHAR,
    fulltext VARCHAR NOT NULL,
    upVotes INTEGER,
    downVotes INTEGER
);

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    id INTEGER PRIMARY KEY,
    username VARCHAR NOT NULL REFERENCES User,
    publication_id INTEGER REFERENCES Publication(id),
    comment_id INTEGER NULL REFERENCES Comment(id), -- self relationship
    timestamp DATETIME CHECK (timestamp > 0), -- date when this was published
    tags VARCHAR, -- comma separated tags
    text VARCHAR NOT NULL,
    upVotes INTEGER,
    downVotes INTEGER
);

-- Table: Votes
DROP TABLE IF EXISTS Votes;

CREATE TABLE Votes(
    id INTEGER PRIMARY KEY,
    type CHAR CHECK (type = 'C' OR type = 'P'),
    username VARCHAR REFERENCES User,
    publication_id INTEGER NULL REFERENCES Publication(id),
    comment_id INTEGER NULL REFERENCES Comment(id),
    upDown INTEGER NOT NULL CHECK (upDown = -1 OR upDown = 1)
);

-- ADD COMMENT UP
CREATE TRIGGER IF NOT EXISTS AddCommentUpVote
AFTER INSERT ON Votes
WHEN NEW.type = 'C' AND NEW.upDown = 1 AND NEW.comment_id IS NOT NULL
BEGIN
    UPDATE Comment SET upVotes = upVotes + 1 WHERE id = NEW.id;
    UPDATE User
    SET points = points + 1
    WHERE username IN
    (
        SELECT username
        FROM Comment
        WHERE id = NEW.comment_id
    );
END;
-- REMOVE COMMENT UP
CREATE TRIGGER IF NOT EXISTS RemoveCommentUpVote
AFTER DELETE ON Votes
WHEN OLD.type = 'C' AND OLD.upDown = 1 AND OLD.comment_id IS NOT NULL
BEGIN
    UPDATE Comment SET upVotes = upVotes - 1 WHERE id = OLD.id;
    UPDATE User
    SET points = points - 1
    WHERE username IN
    (
        SELECT username
        FROM Comment
        WHERE id = OLD.comment_id
    );
END;
-- ADD COMMENT DOWN
CREATE TRIGGER IF NOT EXISTS AddCommentDownVote
AFTER INSERT ON Votes
WHEN NEW.type = 'C' AND NEW.upDown = -1 AND NEW.comment_id IS NOT NULL
BEGIN
    UPDATE Comment SET downVotes = downVotes + 1 WHERE id = NEW.id;
    UPDATE User
    SET points = points - 1
    WHERE username IN
    (
        SELECT username
        FROM Comment
        WHERE id = NEW.comment_id
    );
END;
-- REMOVE COMMENT DOWN
CREATE TRIGGER IF NOT EXISTS RemoveCommentDownVote
AFTER DELETE ON Votes
WHEN OLD.type = 'C' AND OLD.upDown = -1 AND OLD.comment_id IS NOT NULL
BEGIN
    UPDATE Comment SET downVotes = downVotes - 1 WHERE id = OLD.id;
    UPDATE User
    SET points = points + 1
    WHERE username IN
    (
        SELECT username
        FROM Comment
        WHERE id = OLD.comment_id
    );
END;
-- ADD PUBLICATION UP
CREATE TRIGGER IF NOT EXISTS AddPublicationUpVote
AFTER INSERT ON Votes
WHEN NEW.type = 'P' AND NEW.upDown = 1 AND NEW.publication_id IS NOT NULL
BEGIN
    UPDATE Publication SET upVotes = upVotes + 1 WHERE id = NEW.id;
    UPDATE User
    SET points = points + 10
    WHERE username IN
    (
        SELECT username
        FROM Publication
        WHERE id = NEW.publication_id
    );
END;
-- REMOVE PUBLICATION UP
CREATE TRIGGER IF NOT EXISTS RemovePublicationUpVote
AFTER DELETE ON Votes
WHEN OLD.type = 'P' AND OLD.upDown = 1 AND OLD.publication_id IS NOT NULL
BEGIN
    UPDATE Publication SET upVotes = upVotes - 1 WHERE id = OLD.id;
    UPDATE User
    SET points = points - 10
    WHERE username IN
    (
        SELECT username
        FROM Publication
        WHERE id = OLD.publication_id
    );
END;
-- ADD PUBLICATION DOWN
CREATE TRIGGER IF NOT EXISTS AddPublicationDownVote
AFTER INSERT ON Votes
WHEN NEW.type = 'P' AND NEW.upDown = -1 AND NEW.publication_id IS NOT NULL
BEGIN
    UPDATE Publication SET downVotes = downVotes + 1 WHERE id = NEW.id;
    UPDATE User
    SET points = points - 10
    WHERE username IN
    (
        SELECT username
        FROM Publication
        WHERE id = NEW.publication_id
    );
END;
-- REMOVE PUBLICATION DOWN
CREATE TRIGGER IF NOT EXISTS RemovePublicationDownVote
AFTER DELETE ON Votes
WHEN OLD.type = 'P' AND OLD.upDown = -1 AND OLD.publication_id IS NOT NULL
BEGIN
    UPDATE Publication SET downVotes = downVotes - 1 WHERE id = OLD.id;
    UPDATE User
    SET points = points + 10
    WHERE username IN
    (
        SELECT username
        FROM Publication
        WHERE id = OLD.publication_id
    );
END;

INSERT INTO Channel VALUES (NULL, 'General');
INSERT INTO Channel VALUES (NULL, 'Christianity');
INSERT INTO Channel VALUES (NULL, 'Islamism');
INSERT INTO Channel VALUES (NULL, 'Hinduism');
INSERT INTO Channel VALUES (NULL, 'Buddhism');
INSERT INTO Channel VALUES (NULL, 'Baháí Faith');
INSERT INTO Channel VALUES (NULL, 'Jainism');
INSERT INTO Channel VALUES (NULL, 'Judaism');
INSERT INTO Channel VALUES (NULL, 'Paganism');
INSERT INTO Channel VALUES (NULL, 'Shintoism');
INSERT INTO Channel VALUES (NULL, 'Sikhism');
INSERT INTO Channel VALUES (NULL, 'Taoism');
INSERT INTO Channel VALUES (NULL, 'Folk Channels');
INSERT INTO Channel VALUES (NULL, 'IrChannel');

INSERT INTO User VALUES (
    'Antero13',
    'antero@gmail.com',
    'cdb56f6c494214b5c6cfa536daf2e42929e430e9',
    '','','',0,0);

INSERT INTO User VALUES (
    'Pedro459669',
    'pedro@gmail.com',
    '79e9dc154939fb9d31d59c4b1082d7b29edd6415',
    '','','',0,0);

INSERT INTO User VALUES (
    'Andre548392',
    'andre@gmail.com',
    '8ef49ffc8627c1efffda5812de595253b788185e',
    '','','',0,0);

INSERT INTO UserLikesChannel VALUES(
    2,
    'Antero13'
);

INSERT INTO UserLikesChannel VALUES(
    2,
    'Pedro459669'
);

INSERT INTO UserLikesChannel VALUES(
    3,
    'Andre548392'
);

INSERT INTO Publication VALUES (
    NULL,
    'Antero13',
    '2018-08-12',
    'Buddhism,Taoism',
    'first pub',
    'some text',
    0,
    0
);

INSERT INTO Publication VALUES (
    NULL, 
    'Pedro459669',
    '2018-12-03',
    'Buddhism',
    'TITLLEEEE',
    'TEXTTTT',
    0,
    0
);

INSERT INTO Comment VALUES(
    NULL,
    'Andre548392',
    1,
    NULL,
    '2018-12-04',
    'Pedro459669,Antero13',
    'I THINK THAT THIS IS LIT AF',
    0,
    0
);

INSERT INTO Comment VALUES(
    NULL,
    'Antero13',
    1,
    NULL,
    '2018-12-04',
    'Pedro459669',
    'nothing else',
    0,
    0
);

INSERT INTO Comment VALUES(
    NULL,
    'Andre548392',
    NULL,
    2,
    '2018-12-04',
    'Pedro459669',
    'HI_Comment_HERE',
    0,
    0
);

INSERT INTO Votes VALUES(
    NULL,
    'P',
    'Antero13',
    2,
    NULL,
    1
);

INSERT INTO Votes VALUES(
    NULL,
    'P',
    'Pedro459669',
    2,
    NULL,
    1
);

INSERT INTO Votes VALUES(
    NULL,
    'C',
    'Andre548392',
    NULL,
    1,
    -1
);

INSERT INTO Votes VALUES(
    NULL,
    'P',
    'Andre548392',
    1,
    NULL,
    -1
);