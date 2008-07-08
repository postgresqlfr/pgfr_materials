#!/usr/bin/python
# -*- coding: utf-8;
# Ce script tire au sort un mot dans le fichier /usr/share/dict/french

import random, time, sys, pg, csv

FILE = "./Prenoms.txt"

def usage():
    """ Affiche la manière dont il faut utiliser le programme """
    print sys.argv[0],'qte_berger qte_mouton_berger'


fichier = open(FILE)
count = 0

random.seed(time.time())

# on compte les lignes
for l in fichier:
    count = count + 1

# on revient au début
fichier.close()

def vote():
    """ Détermine un mot dans le fichier de dictionnaire (au hasard)"""
    fich = open(FILE)
    fichier = csv.reader(fich,delimiter='\t')
    position = int(random.random() * count)
    if position == 0:
        position = 1

    currentposition = 0
    word = ""
    for l in fichier:
        if currentposition == position:
            word = l[0]
            break
        currentposition = currentposition + 1
    fich.close()
    return word[:-1]
def ajoute_db():

    if len(sys.argv) < 3:
        usage()
        sys.exit(0)
    else:
        b_qty = int(sys.argv[1])
        m_qty = int(sys.argv[2])

    connexion = pg.connect("dbname=pitr-test user=pitruser")


    for iterations_berger in range(0, b_qty):
        ident = int(connexion.query("SELECT nextval('berger_id_seq')").getresult()[0][0])
        insert_query = "INSERT INTO berger(id,nom,prenom) VALUES (%d,'%s','%s');"%(ident,vote(),vote())
        connexion.query(insert_query)
        for iteration_mouton in range(0,m_qty):
            m_ident = int(connexion.query("SELECT nextval('mouton_id_seq')").getresult()[0][0])
            insert_query = "INSERT INTO mouton(id,surnom) VALUES (%d,'%s');"%(m_ident,vote())
            connexion.query(insert_query)
            connexion.query("INSERT INTO troupeau VALUES(%d,%d)"%(ident,m_ident))

    connexion.close()

if __name__=="__main__":
    ajoute_db()
