-- Title, Film duration, Films runnning time, director name and forename --

SELECT film.titre_film, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "Durée", film.dateSortie_film, personne.nom, personne.prenom FROM film 
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
------------------------------------------------------------------------------------------------

--Films exceeing 2 hours and 15 minuts

SELECT film.titre_film, DATE_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS "Durée" FROM film 
WHERE film.duree_film > 135
ORDER BY film.duree_film DESC
--------------------------------------------------------------------------------------------

--  All film from an actor --
SELECT film.titre_film, personne.nom, personne.prenom, personne.dateDeNaissance, personne.sexe FROM film
INNER JOIN realisateur ON film.id_realisateur=realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
----------------------------------------------------------------------------------------------------

-- Number of Films by category --
SELECT COUNT(film.id_film) AS "Nombre films", genre.nom_genre FROM genre
INNER JOIN genrer ON genre.id_genre = genrer.id_genre
INNER JOIN film ON genrer.id_film = film.id_film
GROUP BY genre.nom_genre
ORDER BY COUNT(film.id_film) DESC
-------------------------------------------------------------------------------------------------------
-- Number of films by director -- 
SELECT COUNT(film.id_film) AS "Nombre films", personne.nom, personne.prenom FROM personne
INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
GROUP BY realisateur.id_realisateur
ORDER BY COUNT(film.id_film) DESC
-----------------------------------------------------------------------------------------------------

-- In a precised film, show every actor with name, forename, role 

SELECT personne.nom, personne.prenom, personne.sexe, film.titre_film, role.nom_role FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
INNER JOIN film ON casting.id_film = film.id_film
INNER JOIN role ON casting.id_role = role.id_role
WHERE film.titre_film = "Beau is afraid"

------------------------------------------------------------------------------------------

-- search for directors who are actors too -- 
SELECT personne.nom, personne.prenom, personne.sexe FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne

----------------------------------------------------------------------------------------

--  Select films produced in the 5 last year) --
SELECT film.titre_film  FROM film
WHERE DATE_FORMAT( CURDATE() , "%Y") - CONVERT(film.dateSortie_film, CHAR) < 5

------------------------------------------------------------------------------------------------

-- Films actors older than 50 --

SELECT * FROM personne
LEFT JOIN acteur ON personne.id_personne = acteur.id_personne
WHERE ((YEAR(CURDATE()) - YEAR(personne.dateDeNaissance )) > 50) AND acteur.id_acteur IS NOT NULL


------------------------------------------


-- SELECT peeps having played in 3 films or more -- 
SELECT  personne.nom  FROM personne
INNER JOIN acteur ON acteur.id_personne = personne.id_personne
INNER JOIN casting ON acteur.id_acteur=casting.id_acteur
GROUP BY casting.id_acteur
HAVING COUNT(casting.id_film) > 2