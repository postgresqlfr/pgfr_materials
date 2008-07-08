-- -*- coding: utf-8; -*-
CREATE OR REPLACE FUNCTION nb_employes_surtravail(IN limite INTERVAL) RETURNS INTEGER  AS
$$
DECLARE
        NOMBRE INTEGER;
BEGIN
        NOMBRE := 0;
        SELECT count(*) INTO NOMBRE FROM emp, imputation WHERE emp.id = imputation.emp_id  HAVING sum(imputation.duree) > limite;
        IF NOMBRE IS NULL THEN
           NOMBRE := 0;
        END IF;
        RETURN NOMBRE;
END;
$$
LANGUAGE plpgsql;
COMMENT ON FUNCTION nb_employes_surtravail(IN limite INTERVAL)  IS 'Retourne le nombre d''employés dont le cumul hebdo est supérieur à limite';



DROP TYPE emp_performance CASCADE;
CREATE TYPE emp_performance AS (nom NAME, semaine VARCHAR(7),cumul INTERVAL);
COMMENT ON TYPE emp_performance IS 'Tuple contenant le nom, la semaine sous la forme YYYY-SS, le cumul temporel pour cette semaine';

CREATE OR REPLACE FUNCTION employes_zele(IN duree_legale INTERVAL) RETURNS SETOF emp_performance AS
$$
DECLARE
        ligne emp_performance;
BEGIN
         FOR ligne IN
              SELECT
                     emp.prenom||emp.nom as personne,
                     extract(year from imputation.date_imput)||'-'|| extract(week from imputation.date_imput) as "date",
                     sum(imputation.duree) as heures
              FROM
                     emp, imputation
              WHERE
                     emp.id = imputation.emp_id
              GROUP BY 1,2
              HAVING sum(imputation.duree) > duree_legale
              ORDER BY heures DESC
              LIMIT 1
         LOOP
              RETURN NEXT ligne;
         END LOOP;
END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION employes_en_surtravail(IN duree_legale INTERVAL) RETURNS SETOF emp_performance AS
$$
DECLARE
        ligne emp_performance;
BEGIN
         FOR ligne IN
              SELECT
                     emp.prenom||emp.nom as personne,
                     extract(year from imputation.date_imput)||'-'|| extract(week from imputation.date_imput) as "date",
                     sum(imputation.duree) as heures
              FROM
                     emp, imputation
              WHERE
                     emp.id = imputation.emp_id
              GROUP BY 1,2
              HAVING sum(imputation.duree) > duree_legale
         LOOP
              RETURN NEXT ligne;
         END LOOP;
END
$$
LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION genere_journal_imputations() RETURNS TRIGGER AS
$$
DECLARE
        l_journal journal%ROWTYPE;
BEGIN
        IF TG_OP = 'INSERT' THEN
           l_journal.operation := 'A';
           l_journal.duree := NEW.duree;
           l_journal.emp_id := NEW.emp_id;
           l_journal.projet_id := NEW.projet_id;
           l_journal.date_imput := NEW.date_imput;
        ELSIF TG_OP = 'UPDATE' THEN
           l_journal.operation := 'M';
           l_journal.duree := NEW.duree;
           l_journal.emp_id := NEW.emp_id;
           l_journal.projet_id := NEW.projet_id;
           l_journal.date_imput := NEW.date_imput;
        ELSIF TG_OP = 'DELETE' THEN
           l_journal.operation := 'S';
           l_journal.duree := ('-'||OLD.duree)::INTERVAL;
           l_journal.emp_id := OLD.emp_id;
           l_journal.projet_id := OLD.projet_id;
           l_journal.date_imput := OLD.date_imput;
        END IF;
        l_journal.date_entree := CURRENT_TIMESTAMP;
        l_journal.origine := CURRENT_USER;

        -- Insertion des donnees dans le journal
        INSERT INTO journal VALUES (l_journal.date_entree, l_journal.origine,
                                    l_journal.projet_id,   l_journal.emp_id,
                                    l_journal.operation,   l_journal.date_imput,
                                    l_journal.duree);
       RETURN NEW;
END
$$
LANGUAGE plpgsql;

-- DROP TRIGGER gen_journal_imputations;
CREATE TRIGGER gen_journal_imputations AFTER INSERT OR UPDATE OR DELETE ON imputation
       FOR EACH ROW EXECUTE PROCEDURE genere_journal_imputations();