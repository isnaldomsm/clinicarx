CREATE TABLE users (
    id INTEGER NOT NULL CONSTRAINT users_pk PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);

CREATE TABLE articles (
    id INTEGER NOT NULL CONSTRAINT articles_pk PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL CONSTRAINT users_user_id_fk REFERENCES users,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    body TEXT,
    published BOOLEAN DEFAULT FALSE,
    created DATETIME,
    modified DATETIME
);

CREATE UNIQUE INDEX articles_slug_uindex ON articles (slug);

CREATE TABLE tags (
    id INTEGER NOT NULL CONSTRAINT tags_pk PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(191) NOT NULL,
    created DATETIME,
    modified DATETIME
);

CREATE UNIQUE INDEX tags_title_uindex ON tags (title);

CREATE TABLE articles_tags (
    article_id INTEGER NOT NULL CONSTRAINT articles_id_fk REFERENCES articles,
    tag_id INTEGER NOT NULL CONSTRAINT tags_id_fk REFERENCES tags,
    CONSTRAINT articles_tags_pk PRIMARY KEY (article_id, tag_id)
);

INSERT INTO users (email, password, created, modified)
VALUES
('cakephp@example.com', 'sekret', NOW(), NOW());

INSERT INTO articles (user_id, title, slug, body, published, created, modified)
VALUES
(1, 'First Post', 'first-post', 'This is the first post.', 1, now(), now());
