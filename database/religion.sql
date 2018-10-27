CREATE TABLE religion (
    rel_id INTEGER PRIMARY KEY,
    rel_type VARCHAR NOT NULL
);

CREATE TABLE user (
    usrUsername VARCHAR PRIMARY KEY,
    usrPassword VARCHAR NOT NULL
);

INSERT INTO religion VALUES (NULL, 'Christianity');
INSERT INTO religion VALUES (NULL, 'Islamism');
INSERT INTO religion VALUES (NULL, 'Hinduism');
INSERT INTO religion VALUES (NULL, 'Buddhism');
INSERT INTO religion VALUES (NULL, 'Baháí Faith');
INSERT INTO religion VALUES (NULL, 'Jainism');
INSERT INTO religion VALUES (NULL, 'Judaism');
INSERT INTO religion VALUES (NULL, 'Paganism');
INSERT INTO religion VALUES (NULL, 'Shintoism');
INSERT INTO religion VALUES (NULL, 'Sikhism');
INSERT INTO religion VALUES (NULL, 'Taoism');
INSERT INTO religion VALUES (NULL, 'Folk religions');
INSERT INTO religion VALUES (NULL, 'Irreligion');

INSERT INTO user VALUES ('Antero', 'cdb56f6c494214b5c6cfa536daf2e42929e430e9');
INSERT INTO user VALUES ('Pedro', '79e9dc154939fb9d31d59c4b1082d7b29edd6415');
INSERT INTO user VALUES ('Andre', '8ef49ffc8627c1efffda5812de595253b788185e');