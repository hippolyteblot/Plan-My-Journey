<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>

</head>
<div id="background-img">
</div>
<main id="accueil">
    <h1>Quel genre de parcours voulez-vous ?</h1>
  <div class="glass">
    
    <form action="?page=preferencesSelection" method="post">
        <div class="formItem">
            <h2>Lieux selectionné : </h2>
            <select name="lieux" id="lieux">
                <?php
                foreach ($_SESSION['candidates'] as $place) {
                    echo "<option value='".$place['formatted_address']."'>".$place['formatted_address']."</option>";
                }
                ?>
            </select>
        </div>
        <div id="options">
            <div class="formItem">
                <h2 for="time">Quelles horaires ?</h2>
                <!-- From ? to ? -->
                <div class="time inputGroup">
                    <div class="timeItem">
                        <label for="timeFrom">De </label>
                        <input type="time" name="timeFrom" id="timeFrom" value="10:00">
                    </div>
                    
                    <div class="timeItem">
                        <label for="timeTo">A </label>
                        <input type="time" name="timeTo" id="timeTo" value="18:00">
                    </div>
                </div>
            </div>
            <div class="formItem">
                <h2 for="budget">Quel budget ?</h2>
                <div class="budget inputGroup">
                    <div class="budgetItem">
                        <!-- Choice between 3 budgets -->
                        <label for="budget">Budget : </label>
                        <select name="budget" id="budget">
                            <option value="1">€</option>
                            <option value="2">€€</option>
                            <option value="3">€€€</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="formItem">
                <h2 for="type">Prévoir à manger ?</h2>
                <div class="type inputGroup">
                    <label for="restaurant">Restauration : </label>
                    <select name="restaurant" id="restaurant">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
            </div>
            <div class="formItem">
                <h2 for="type">Continuer ?</h2>
                <div class="type inputGroup">
                    <button type="submit" name="submitParameters" id="submit">Valider</button>
                </div>
            </div>
            
        </div>
      
    </form>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>