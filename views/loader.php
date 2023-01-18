<style>
    
</style>
<link rel="stylesheet" href="<?= PATH_CSS ?>loader.css" />
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="https://d3js.org/topojson.v1.min.js"></script>
<script defer src="<?= PATH_SCRIPTS ?>earth.js"></script>

<article id="loader">
    <section id="turnglobe">
        <img src="<?= PATH_IMAGES ?>logo_no_earth.png" alt="earth" id="earth">
        <div id="worldmap"></div>
        <p id="loading">Chargement du parcours...</p>
    </section>
</article>