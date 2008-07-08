--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: jarnu
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO jarnu;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: berger; Type: TABLE; Schema: public; Owner: pitruser; Tablespace: 
--

CREATE TABLE berger (
    id integer NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255) NOT NULL
);


ALTER TABLE public.berger OWNER TO pitruser;

--
-- Name: mouton; Type: TABLE; Schema: public; Owner: pitruser; Tablespace: 
--

CREATE TABLE mouton (
    id integer NOT NULL,
    surnom character varying(250) NOT NULL
);


ALTER TABLE public.mouton OWNER TO pitruser;

--
-- Name: troupeau; Type: TABLE; Schema: public; Owner: pitruser; Tablespace: 
--

CREATE TABLE troupeau (
    berger_id integer NOT NULL,
    mouton_id integer NOT NULL
);


ALTER TABLE public.troupeau OWNER TO pitruser;

--
-- Name: berger_id_seq; Type: SEQUENCE; Schema: public; Owner: pitruser
--

CREATE SEQUENCE berger_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.berger_id_seq OWNER TO pitruser;

--
-- Name: berger_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pitruser
--

ALTER SEQUENCE berger_id_seq OWNED BY berger.id;


--
-- Name: mouton_id_seq; Type: SEQUENCE; Schema: public; Owner: pitruser
--

CREATE SEQUENCE mouton_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mouton_id_seq OWNER TO pitruser;

--
-- Name: mouton_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pitruser
--

ALTER SEQUENCE mouton_id_seq OWNED BY mouton.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pitruser
--

ALTER TABLE berger ALTER COLUMN id SET DEFAULT nextval('berger_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pitruser
--

ALTER TABLE mouton ALTER COLUMN id SET DEFAULT nextval('mouton_id_seq'::regclass);


--
-- Name: berger_pkey; Type: CONSTRAINT; Schema: public; Owner: pitruser; Tablespace: 
--

ALTER TABLE ONLY berger
    ADD CONSTRAINT berger_pkey PRIMARY KEY (id);


--
-- Name: mouton_pkey; Type: CONSTRAINT; Schema: public; Owner: pitruser; Tablespace: 
--

ALTER TABLE ONLY mouton
    ADD CONSTRAINT mouton_pkey PRIMARY KEY (id);


--
-- Name: troupeau_pkey; Type: CONSTRAINT; Schema: public; Owner: pitruser; Tablespace: 
--

ALTER TABLE ONLY troupeau
    ADD CONSTRAINT troupeau_pkey PRIMARY KEY (berger_id, mouton_id);


--
-- Name: troupeau_berger_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pitruser
--

ALTER TABLE ONLY troupeau
    ADD CONSTRAINT troupeau_berger_id_fkey FOREIGN KEY (berger_id) REFERENCES berger(id);


--
-- Name: troupeau_mouton_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pitruser
--

ALTER TABLE ONLY troupeau
    ADD CONSTRAINT troupeau_mouton_id_fkey FOREIGN KEY (mouton_id) REFERENCES mouton(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

