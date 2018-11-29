CREATE TABLE channel (
    id INTEGER PRIMARY KEY,
    cType VARCHAR NOT NULL
);

CREATE TABLE userLikesChannel (
    id_channel INTEGER REFERENCES channel(id),
    username_user VARCHAR REFERENCES user(username)
);

CREATE TABLE user (
    username VARCHAR PRIMARY KEY,
    password VARCHAR NOT NULL
);

CREATE TABLE publication (
    id INTEGER PRIMARY KEY,
    type CHAR NOT NULL,
    title VARCHAR,
    published INTEGER, -- date when this was published
    tags VARCHAR NOT NULL, -- comma separated tags
    username VARCHAR REFERENCES user,
    introduction VARCHAR,
    fulltext VARCHAR NOT NULL,
    image_path VARCHAR,
    upVote INTEGER,
    downVote INTEGER
);

CREATE TABLE comment (
    id INTEGER PRIMARY KEY,
    type CHAR NOT NULL,
    news_id INTEGER REFERENCES publication,
    username VARCHAR REFERENCES user,
    comment_to INTEGER NULL REFERENCES comment(id), -- self relationship
    published INTEGER, -- date when this was published
    tags VARCHAR, -- comma separated tags
    text VARCHAR NOT NULL,
    upVote INTEGER,
    downVote INTEGER
);

CREATE TABLE voted(
    id INTEGER PRIMARY KEY,
    type CHAR NOT NULL,
    username VARCHAR REFERENCES user, 
    id_publication INTEGER NULL REFERENCES publication(id),
    id_comment INTEGER NULL REFERENCES comment(id)
);

INSERT INTO channel VALUES (NULL, 'General');
INSERT INTO channel VALUES (NULL, 'Christianity');
INSERT INTO channel VALUES (NULL, 'Islamism');
INSERT INTO channel VALUES (NULL, 'Hinduism');
INSERT INTO channel VALUES (NULL, 'Buddhism');
INSERT INTO channel VALUES (NULL, 'Baháí Faith');
INSERT INTO channel VALUES (NULL, 'Jainism');
INSERT INTO channel VALUES (NULL, 'Judaism');
INSERT INTO channel VALUES (NULL, 'Paganism');
INSERT INTO channel VALUES (NULL, 'Shintoism');
INSERT INTO channel VALUES (NULL, 'Sikhism');
INSERT INTO channel VALUES (NULL, 'Taoism');
INSERT INTO channel VALUES (NULL, 'Folk channels');
INSERT INTO channel VALUES (NULL, 'Irchannel');

INSERT INTO user VALUES ('Antero13', 'cdb56f6c494214b5c6cfa536daf2e42929e430e9');
INSERT INTO user VALUES ('Pedro459669', '79e9dc154939fb9d31d59c4b1082d7b29edd6415');
INSERT INTO user VALUES ('Andre548392', '8ef49ffc8627c1efffda5812de595253b788185e');

INSERT INTO userLikesChannel VALUES(
    2,
    'Antero13'
);

INSERT INTO userLikesChannel VALUES(
    2,
    'Pedro459669'
);

INSERT INTO userLikesChannel VALUES(
    3,
    'Andre548392'
);

INSERT INTO publication VALUES (
    NULL, 
    'P',
    'First PUBLICATION',
    1507901651,
    'Buddhism,Christianity',
    'Antero13',
    'Nam aliquet leo vel scelerisque sagittis. Praesent hendrerit lectus et augue condimentum, vitae dapibus elit bibendum. Quisque id sapien nec nisl commodo vulputate. Cras vehicula semper lectus. Duis a purus in velit iaculis luctus id ac justo. Mauris a lectus eu dui aliquam pretium nec a massa. Suspendisse risus metus, laoreet quis velit eu, mollis auctor tellus. Maecenas vulputate, nulla a commodo porttitor, urna arcu viverra dolor, a eleifend lectus leo a justo.',
    'Morbi bibendum volutpat pellentesque. In bibendum est et orci semper rhoncus. Sed cursus vel orci sed malesuada. Fusce ac dictum ligula, quis hendrerit ipsum. Proin hendrerit a.

Nulla commodo eu nulla ac facilisis. Donec ante lorem, tincidunt nec interdum vulputate, fringilla a urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sapien erat, suscipit a nisl sed, molestie convallis eros. Curabitur egestas massa et metus dignissim, et vestibulum libero porttitor. Sed non metus pharetra, lobortis orci a, commodo diam. Praesent a sagittis massa, quis condimentum augue. Donec id est feugiat ipsum egestas vulputate vel in dolor. Pellentesque pretium placerat lorem, sed sodales diam molestie a. Donec dictum dui ut accumsan tempor. Nam vestibulum in erat et sagittis. Donec venenatis, ante vitae tristique tristique, nisi metus aliquet.',
    NULL,
    0,
    0
);

INSERT INTO publication VALUES (
    NULL, 
    'P',
    'First PUBLICATION',
    1507901651,
    'Buddhism',
    'Pedro459669',
    'TITLLEEEE',
    'TEXTTTT',
    NULL,
    0,
    0
);

INSERT INTO comment VALUES(
    NULL,
    'C',
    1,
    'Andre548392',
    NULL,
    1508247632,
    'Pedro459669,Antero13',
    'I THINK THAT THIS IS LIT AF',
    0,
    0
);

INSERT INTO voted VALUES(
    NULL,
    'P',
    'Antero13',
    2,
    NULL
);

INSERT INTO voted VALUES(
    NULL,
    'C',
    'Andre548392',
    NULL,
    1
);