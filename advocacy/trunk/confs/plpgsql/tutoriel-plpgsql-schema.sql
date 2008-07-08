CREATE TABLE service(
       id SERIAL PRIMARY KEY,
       nom VARCHAR(100) NOT NULL);

CREATE TABLE emp (
       id SERIAL PRIMARY KEY,
       nom VARCHAR(255) NOT NULL,
       prenom VARCHAR(255) NOT NULL,
       service INTEGER REFERENCES service(id));

CREATE TABLE projet(
       id SERIAL PRIMARY KEY,
       nom VARCHAR(100) NOT NULL);

CREATE TABLE imputation(
       emp_id INTEGER REFERENCES emp(id),
       projet_id INTEGER REFERENCES projet(id),
       duree INTERVAL NOT NULL CHECK (duree > '0 hour' and duree < '24 hours'),
       date_imput DATE NOT NULL,
       imput_date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       imput_date_modif TIMESTAMP,
       PRIMARY KEY (emp_id, projet_id, date_imput) );


CREATE TABLE journal(
       date_entree TIMESTAMP NOT NULL,
       origine NAME NOT NULL,
       projet_id INTEGER ,
       emp_id INTEGER ,
       operation CHARACTER NOT NULL,
       date_imput DATE ,
       duree INTERVAL NOT NULL
);

