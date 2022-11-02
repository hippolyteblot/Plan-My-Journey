<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>accueil.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Découvrer votre planning de rêve</h1>
    <h2>Utilisez notre moteur de recherche et trouvez votre journée de rêve en un clic</h2>
    <form action="index.php?page=query" method="post">
      <div class="formItem item01"><input id="input01" type="text" name="search" placeholder="    Saisissez votre destination"></div>
      <div class="formItem item02">

        <button id="input02" type="Submit">
          <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
          <div class="svg">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2500.95 2500.95" style="enable-background:new 0 0 2500.95 2500.95;" xml:space="preserve">
              <g>
                <g>
                  <path d="M481.8,453l-140-140.1c27.6-33.1,44.2-75.4,44.2-121.6C386,85.9,299.5,0.2,193.1,0.2S0,86,0,191.4s86.5,191.1,192.9,191.1
			c45.2,0,86.8-15.5,119.8-41.4l140.5,140.5c8.2,8.2,20.4,8.2,28.6,0C490,473.4,490,461.2,481.8,453z M41,191.4
			c0-82.8,68.2-150.1,151.9-150.1s151.9,67.3,151.9,150.1s-68.2,150.1-151.9,150.1S41,274.1,41,191.4z" />
                </g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
            </svg>
          </div>

        </button>


      </div>
  </div>
  <span>
    Swipe up !
  </span>
</main>

<?php require_once(PATH_VIEWS . 'footer.php'); ?>