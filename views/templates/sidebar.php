<div class="sidebar">
    <div class="list">
        <ul>
            <li><a href = "index.php">Vue d'ensemble</a></li>
            <li>Modifier - Ajouter - Supprimer</li>
            <li><a href ="index.php?action=displayFilms">Films</a></li>
            <li><a href ="index.php?action=displayReals">Réalisateur / Réalisatrices</a></li>
            <li><a href ="index.php?action=displayActeurs">Acteurs / Actrices</a></li>
            <li><a href ="index.php?action=displayGenres">Genres</a></li>
            <li><a href ="index.php?action=displayFilmsGenres">Films&Genres</a></li>
            <li><a href ="index.php?action=displayRoles">Roles</a></li>
            <li><a href ="index.php?action=displayCastings">Casting</a></li>
            <li>Statistiques</li>
            <select name="forma"  class="selectSidebar" onchange="location = this.value;">
            <option>Sélectionnez la catégorie</option>
            <option value ="index.php?action=displayStatsFilms">Films</option>
            <option value ="index.php?action=displayStatsReals">Réalisateur / Réalisatrices</option>
            <option value ="index.php?action=displayStatsActeurs">Acteurs / Actrices</option>
            <option value ="index.php?action=displayStatsGenres">Genres</option>
            <option value ="index.php?action=displayStatsRoles">Roles</option>
            <option value ="index.php?action=displayStatsCastings">Castings</option>
            </select>
        </ul>
    </div>
</div>