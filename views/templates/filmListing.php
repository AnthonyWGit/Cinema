<?php ob_start() ;?>

<!DOCTYPE html>
<div class="listeFilm">
    <table>
    <tr>
        <th>Numéro</th>
        <th>Titre du film</th>
        <th>Synopsis</th>
        <th>Durée du film</th>
        <th>Année de sortie</th>
        <th>Réalisateur</th>
        <th>Image</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </table>
</div>

<?php $content=ob_get_clean(); ?>