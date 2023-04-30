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



