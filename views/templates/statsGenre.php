<?php ob_start()?>

<div class="statsFlex">
    <div class="col">
        <p>
            <span class="yellow">Nombre de films par genre</span>

            <table>
            <tr>
                <th>Genre</th>
                <th>Film</th>
            </tr>
            <tr>

            <?php 
            foreach($rawFilmsByGenre as $film)

            {?>
                <tr>
                    <td><?= $film["nom_genre"]?></td>
                    <td><?= $film["Nombre films"] ?></td>
                </tr>
            <?php
            }?>
            
            </tr>
            </table>

            </ul>
        </p>
    </div>
</div>
<?php 
$content = ob_get_clean();
require_once("views/templates/layoutStats.php");
?>
