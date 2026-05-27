<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

session_start();

include "../APIs/services/DBconnect.php";
include "../APIs/services/usrCheck.php";
include("../APIs/store/getRoutines.php");
include_once("../APIs/store/getTags.php");

$res = getRoutines($conn);
$routines = $res["routines"];

$res = getTags($conn);
$tags = $res["tags"];
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyOrganized – Store</title>

  <!-- Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
  <link href="https://fonts.cdnfonts.com/css/segoe-ui-variable-static-display" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- CSS globali -->
  <link rel="stylesheet" href="../CSS/fontSettings.css">
  <link rel="stylesheet" href="../CSS/interCSS.css">

  <!-- CSS pagina Store -->
  <link rel="stylesheet" href="../CSS/store.css?v=1.1">
</head>

<body>

  <!-- NAVBAR (gestita da interCSS) -->
  <div class="navBar">
    <div class="navBar-L">
      <span class="navBar-Brand">MyOrganized</span>
      <div class="navBar-Link">
        <a href="home.php">Panoramica</a>
        <a href="#" class="Active">Store</a>
        <a href="planner.html">Planner</a>
      </div>
    </div>

    <a href="./profile-info.php">
      <div class="navBar-R">
        <span class="navBar-UsrName">John Appleseed</span>
        <img class="navBar-Avatar" src="./img/defaultProfile.jpg" alt="">
      </div>
    </a>
  </div>

  <!-- CONTENUTO -->
  <div class="mainView">
    <div class="storeContent">

      <!-- Titolo + sottotitolo -->
      <h1 class="superTitle">Store</h1>
      <h2 class="subTitle">
        Acquista pacchetti di Routine Quotidiane per diventare più produttivo.
      </h2>

      <!-- Search bar -->
      <form class="store-searchForm" method="get">
        <input type="text" name="keyword" class="store-searchInput" placeholder="Cosa stai cercando...">
        <button type="submit" class="store-searchButton">
          <i class="bi bi-arrow-right"></i>
        </button>
      </form>
        
        <!-- Filtri -->
      <form class="store-searchForm" method="get">
        <div class="store-filtersRow">
          <i class="bi bi-funnel-fill"></i>
          <span class="store-filtersLabel">Filtri di ricerca:</span>
          
          <input type="radio" name="filter" id="filter-all" value="" 
           <?php echo (!isset($_GET['filter']) || $_GET['filter'] === '') ? 'checked' : ''; ?> 
           onChange="this.form.submit()" class="store-radioFilter">
          <label for="filter-all" class="store-filterBtn">Tutti</label>

          <?php 
            foreach($tags as $tag){
              $isSelected = (isset($_GET['filter']) && $_GET['filter'] == $tag["id"]) ? 'checked' : '';
              ?>
              <!-- <button class="store-filterBtn"><?php //echo $tag["descriz"] ?></button> -->

              <input type="radio" name="filter" id="filter-<?php echo $tag["id"] ?>" value="<?php echo $tag["id"] ?>" 
              <?php echo $isSelected; ?> onChange="this.form.submit()" class="store-radioFilter">
        
              <label for="filter-<?php echo $tag["id"] ?>" class="store-filterBtn">
                <?php echo $tag["descriz"] ?>
              </label>
              <?php
            }
          ?>
        </div>
      </form>

      

      <!-- In Tendenza -->
      <h3 class="store-sectionTitle">ADESSO IN MYORGANIZED</h3>

      <!-- Cards -->
      <div class="store-cardsRow">
        
        <!-- Card 1 -->
        <?php 
        foreach($routines as $routine){
          ?>

          <article class="store-card">
          <div class="store-cardImageWrapper">
            <img src=" <?php echo $routine["img"] ?> " alt="Routine di<?php echo $routine["title"] ?> " class="store-cardImage">
          </div>

          <div class="store-cardBody">
            <div class="store-cardMeta"><?php echo $routine["metatag"] ?></div>
            <h4 class="store-cardTitle">Routine di <?php echo $routine["title"] ?></h4>
            <p class="store-cardText">
              <?php echo $routine["subtitle"] ?>
            </p>
          </div>

          <div class="store-cardFooter">
            <button class="store-cardButton">
              Scopri di Più
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </article>

        <?php
        }
        ?>

      </div>

    </div>
  </div>

  <script src="../JS/store.js"></script>
</body>

</html>
