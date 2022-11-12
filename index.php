<?php
include "./connect.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Meta Informacion -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sinmbas</title>
  <!-- Css -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/index.css">
  <!-- Link awesomefont icons -->
  <script src="https://kit.fontawesome.com/307e9e536a.js" crossorigin="anonymous"></script>
</head>

<body>
  <div id="grid-layout" class="grid-layout">

    <header id="grid-layout__head" class="grid-layout__head">
      <?php include "./index/header.php" ?>
    </header>

    <nav id="grid-layout__nav" class="grid-layout__nav">
      <?php include "./index/nav.php" ?>
    </nav>

    <main id="grid-layout__main" class="grid-layout__main">
      <iframe id="iframe_main" src="" name="iframe_main"></iframe>
      <button id="btn-toggle" class="aside__btn-toggle"><i class="aside__icon-toggle fa-solid fa-caret-right"></i></button>
    </main>

    <aside id="grid-layout__aside" class="grid-layout__aside">
      <iframe id="iframe_aside" src="" name="iframe_aside"></iframe>
    </aside>

    <footer id="grid-layout__foot" class="grid-layout__foot">
      <?php include "./index/footer.php" ?>
    </footer>

  </div>
  <script src="./js/index.js"></script>
</body>

</html>
