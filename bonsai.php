<?php 

session_start();

    if (!isset($_SESSION["data"])) {
      $data = file_get_contents("https://openapi.etsy.com/v2/shops/BentlySkunkworksShop/listings/active?method=GET&api_key=r645z2pvk8ptxcr6dz8y0oqp&fields=title,price,url&limit=100&includes=MainImage");
      $_SESSION["data"] = $data;
    } else {
      $data = $_SESSION["data"];
      $items = json_decode($data);
    }
    
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;500&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF"
      crossorigin="anonymous"
    />
    <link href="assets/css/style.css" rel="stylesheet" />
    <title>Bonsai Pots | Bently Skunkworks | Locally made pottery</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Bently Skunkworks</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Products
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink"
              >
              <li><a class="dropdown-item" href="/bonsai.php">Bonsai Pots</a></li>
                <li><a class="dropdown-item" href="/sake.php">Sake Kits</a></li>
                <li>
                  <a class="dropdown-item" href="/other.php">Misc Cool Stuff</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#about">About Bently Skunkworks</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      <div class="header">
        <div class="content">
          <div class="image">
            <img src="assets/img/bonsai.jpg" />
          </div>
          <div class="info">
            <div class="infoBox">
              <h1>Bently Skunkworks</h1>
              <p>Bonsai Pots</p>
            </div>
          </div>
        </div>
      </div>

      <div class="featuredProducts">
        <div class="content">
          <h2>Featured Products</h2>
          <div class="imageBox">
            <?php
            foreach($items->results as $item) {
              if ((explode("-",$item->sku[0]))[0] == "BP") {
                echo "<a href=".$item->url." target='_blank'><div class='item'>
                <img src=".$item->MainImage->url_570xN." />
                <h3>$item->title</h3>
                <h4>$ $item->price</h4></a>
              </div>";
              };
            }
            ?>
          </div>
        </div>
      </div>

      
      <footer>
        <p>&copy 2022 - Bently Skunkworks</p>
      </footer>
    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
