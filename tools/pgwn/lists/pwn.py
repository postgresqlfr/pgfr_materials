#!/usr/bin/python
# -*- encoding:iso-8859-1 -*-
# Written by jcarnu@gmail.com
# @author: Jean-Christophe Arnu <mailto:jcarnu@gmail.com>
"""Ce programme permet de pré-formatter un post PostgreSQL Weekly News
au format HTML convenant à drupal. Il permet de faciliter le travail 
de traduction de l'équipe en plaçant les balises et les sections aux
endroits convenables"""
import re,sys
started=False
parstate=False
end=False
lisection=False
autotrans=True

sectionre = re.compile(r'^\s*==\s*(.*)\s*==\s*$')
hrefre = re.compile(r'(.*)\s*(https?://\S*)\s(.*)')
parre = re.compile(r'^\s*$')
parredash = re.compile(r'^\s*-(.*)$')

def usage():
    print "%s <filename>"%sys.argv[0]
    
def autotranslate(sent):                            
    if re.search('^(.*)\s*committed:\s*$', sent):            
        return re.sub('^(.*)committed:\s*$', r'\1 a committé:', sent)        
    #if re.search('^(.*)\s*committed:\s*$', sent):            
        #return re.sub('^(.*)committed:\s*$', r'\1 a committé', sent)        
    else:                                    
        return sent
    
if len(sys.argv) == 2:
    try:
	f=open(sys.argv[1],"r")
	if f!=None:
	    for line in f.readlines():
		bloc = sectionre.match(line)
		if bloc:
		    if lisection:
			print "</ul>"
			lisection=False
			
		    titre=bloc.group(1).strip()
		    if titre=="PostgreSQL Product News":
			titre="Les nouveautés des produits dérivés"
			lisection=True
		    elif titre=="PostgreSQL in the News":
			titre="PostgreSQL dans les média"
			lisection=True
		    elif titre.find("Applied Patches")>=0:
		    	titre="Correctifs appliqués"
			lisection=False
		    elif titre.find("Rejected Patches")>=0:
		    	titre="Correctifs rejetés (à ce jour)"
			lisection=True
			autotrans=True
		    elif titre.find("Pending Patches")>=0:
		    	titre="Correctifs en attente"
			lisection=True
		    elif titre.find("PostgreSQL Weekly News")>=0:
			started=True
			titre=titre.replace("PostgreSQL Weekly News","Nouvelles hebdomadaires de PostgreSQL")
		    if started:
			print "<p><strong>%s</strong></p>"%titre
		    if lisection:
			print "<ul>"
		else:
		    bloc = hrefre.match(line)
		    if bloc:
			if started:
			    print"""%s <a target="_blank" href="%s">%s</a> %s"""%(bloc.group(1),bloc.group(2),bloc.group(2),bloc.group(3))
		    elif parre.match(line):
			if not parstate and started:		
			    if lisection:
				print "<li>"
				ldata = parredash.match(line)
				if ldata:
					line = ldata.group(1)
			    else:
				print"<p>"
			    parstate=True
			elif started:
			    if lisection:
				print "</li>"
			    else:
				print"\n</p>"
			    parstate=False			 
		    else:
			if not end:
			    end = (line.find("---------------------------(end of broadcast)---------------------------")>=0)
			    if end and lisection:
				print "</ul></p>"
				lisection=False
				
			if not parstate and not end and started:
			    if lisection:
				print "<li>"
                                ldata = parredash.match(line)
				if ldata:
					line = ldata.group(1)

			    else:
				print "<p>"
			    parstate=True
			if not end :
			    if autotrans:
				line=autotranslate(line)
				if line.find("No one was disappointed this week :-)")>=0:
				    line="Pas de déception cette semaine :-)"
				#autotrans=False 
			    if parstate:			    
				print line.replace("\n",""),
			    else:
				print line,
	else:
	    print "unable to open %s"%sys.argv[1]
    except:
	print "unable to open %s"%sys.argv[1]
else:
    usage()
