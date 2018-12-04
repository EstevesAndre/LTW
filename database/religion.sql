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
    email VARCHAR UNIQUE,
    password VARCHAR NOT NULL
);

-- Table: Publication
DROP TABLE IF EXISTS Publication;

CREATE TABLE Publication (
    id INTEGER PRIMARY KEY,
    username VARCHAR REFERENCES User,
    timestamp DATETIME CHECK (timestamp > 0), -- date when this was published
    tags VARCHAR NOT NULL, -- comma separated tags
    title VARCHAR,
    fulltext VARCHAR NOT NULL
);

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    id INTEGER PRIMARY KEY,
    username VARCHAR REFERENCES User,
    publication_id INTEGER REFERENCES Publication(id),
    comment_id INTEGER NULL REFERENCES Comment(id), -- self relationship
    timestamp DATETIME CHECK (timestamp > 0), -- date when this was published
    tags VARCHAR, -- comma separated tags
    text VARCHAR NOT NULL
);

-- Table: Votes
DROP TABLE IF EXISTS Votes;

CREATE TABLE Votes(
    id INTEGER PRIMARY KEY,
    type CHAR NOT NULL,
    username VARCHAR REFERENCES User,
    publication_id INTEGER NULL REFERENCES Publication(id),
    comment_id INTEGER NULL REFERENCES Comment(id),
    upDown INTEGER NOT NULL CHECK (upDown = -1 OR upDown = 1)
);

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

INSERT INTO User VALUES ('Antero13', 'antero@gmail.com', 'cdb56f6c494214b5c6cfa536daf2e42929e430e9');
INSERT INTO User VALUES ('Pedro459669', 'pedro@gmail.com', '79e9dc154939fb9d31d59c4b1082d7b29edd6415');
INSERT INTO User VALUES ('Andre548392', 'andre@gmail.com', '8ef49ffc8627c1efffda5812de595253b788185e');

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
    'Buddhism,Christianity',
    'Nam aliquet leo vel scelerisque sagittis. Praesent hendrerit lectus et augue condimentum, vitae dapibus elit bibendum. Quisque id sapien nec nisl commodo vulputate. Cras vehicula semper lectus. Duis a purus in velit iaculis luctus id ac justo. Mauris a lectus eu dui aliquam pretium nec a massa. Suspendisse risus metus, laoreet quis velit eu, mollis auctor tellus. Maecenas vulputate, nulla a commodo porttitor, urna arcu viverra dolor, a eleifend lectus leo a justo.',
    'Morbi bibendum volutpat pellentesque. In bibendum est et orci semper rhoncus. Sed cursus vel orci sed malesuada. Fusce ac dictum ligula, quis hendrerit ipsum. Proin hendrerit a. 
    Nulla commodo eu nulla ac facilisis. Donec ante lorem, tincidunt nec interdum vulputate, fringilla a urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sapien erat, suscipit a nisl sed, molestie convallis eros. Curabitur egestas massa et metus dignissim, et vestibulum libero porttitor. Sed non metus pharetra, lobortis orci a, commodo diam. Praesent a sagittis massa, quis condimentum augue. Donec id est feugiat ipsum egestas vulputate vel in dolor. Pellentesque pretium placerat lorem, sed sodales diam molestie a. Donec dictum dui ut accumsan tempor. Nam vestibulum in erat et sagittis. Donec venenatis, ante vitae tristique tristique, nisi metus aliquet.'
);

INSERT INTO Publication VALUES (
    NULL, 
    'Pedro459669',
    '2018-12-03',
    'Buddhism',
    'TITLLEEEE',
    'TEXTTTT'
);

INSERT INTO Comment VALUES(
    NULL,
    'Andre548392',
    1,
    NULL,
    '2018-12-04',
    'Pedro459669,Antero13',
    'I THINK THAT THIS IS LIT AF'
);

INSERT INTO Comment VALUES(
    NULL,
    'Antero13',
    1,
    NULL,
    '2018-12-04',
    'Pedro459669',
    'nothing else'
);

INSERT INTO Comment VALUES(
    NULL,
    'Andre548392',
    NULL,
    2,
    '2018-12-04',
    'Pedro459669',
    'HI_Comment_HERE'
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
    2,
    NULL,
    -1
);