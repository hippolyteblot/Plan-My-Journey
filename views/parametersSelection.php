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
    
    <form action="" method="post">
        <div class="formItem">
            <h2>Lieux selectionné : <?= $fullAddress ?></h2>
        </div>
        <div class="formItem time">
            <h2 for="time">Quelles horaires ?</h2>
            <!-- From ? to ? -->
            <div class="time inputGroup">
                <div class="timeItem">
                    <label for="timeFrom">De </label>
                    <input type="time" name="timeFrom" id="timeFrom" value="00:00">
                </div>
                <div class="timeItem">
                    <label for="timeTo"> à </label>
                    <input type="time" name="timeTo" id="timeTo" value="23:59">
                </div>
            </div>
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
      
    </form>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>