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
       duree INTERVAL NOT NULL,
       date_imput DATE NOT NULL,
       imput_date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       imput_date_modif TIMESTAMP );