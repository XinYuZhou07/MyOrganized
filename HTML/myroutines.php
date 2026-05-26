<?php
  session_start();
  //echo $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyOrganized – Le mie routine</title>

  <!-- Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="https://fonts.cdnfonts.com/css/segoe-ui-variable-static-display" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- CSS globali -->
  <link rel="stylesheet" href="../CSS/fontSettings.css">
  <link rel="stylesheet" href="../CSS/interCSS.css">

  <!-- CSS pagina Store -->
  <link rel="stylesheet" href="../CSS/store.css">
</head>

<body>

  <!-- NAVBAR -->
  <div class="navBar">
    <div class="navBar-L">
      <span class="navBar-Brand">MyOrganized</span>
      <div class="navBar-Link">
        <a href="./home.html">Panoramica</a>
        <a href="#" class="Active">Store</a>
        <a href="./planner.html">Planner</a>
      </div>
    </div>
    <div class="navBar-R">
      <span class="navBar-UsrName">John Appleseed</span>
      <img class="navBar-Avatar" src="./img/defaultProfile.jpg" alt="">
    </div>
  </div>

  <!-- CONTENUTO -->
  <div class="mainView">
    <div class="storeContent" id="storeContent">
      <!-- card qui -->
    </div>
  </div>

  <script>
    async function loadRoutines() {
      try {
        const res  = await fetch('/myorganized/APIs/usr/getRoutines.php');
        const data = await res.json();
        const container = document.getElementById('storeContent');

        if (!data.routines || data.routines.length === 0) {
          container.innerHTML = '<p class="text-muted">Nessuna routine trovata.</p>';
          return;
        }

        data.routines.forEach(r => {
          const card = document.createElement('article');
          card.className = 'store-card';
          card.innerHTML = `
            <div class="store-cardImageWrapper">
              <img src="./img/gordon.jpg" alt="" class="store-cardImage">
            </div>
            <div class="store-cardBody">
              <div class="store-cardMeta">${escHtml(r.metatag)}</div>
              <h4 class="store-cardTitle">${escHtml(r.title)}</h4>
              <p class="store-cardText">${escHtml(r.subtitle)}</p>
            </div>
            <div class="store-cardFooter">
              <button class="store-cardButton" data-id="${r.id}">
                Scopri di più <i class="bi bi-arrow-right"></i>
              </button>
            </div>`;
          container.appendChild(card);
        });

      } catch (err) {
        console.error('Errore nel caricamento delle routine:', err);
        document.getElementById('storeContent').innerHTML =
          '<p class="text-danger">Errore nel caricamento delle routine.</p>';
      }
    }

    function escHtml(str) {
      const d = document.createElement('div');
      d.textContent = str;
      return d.innerHTML;
    }

    loadRoutines();
  </script>

</body>
</html>