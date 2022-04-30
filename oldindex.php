<?php 
             $data = file_get_contents("https://openapi.etsy.com/v2/shops/BentlySkunkworksShop/listings/active?method=GET&api_key=r645z2pvk8ptxcr6dz8y0oqp&fields=title,price,url&limit=100&includes=MainImage");
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
    <title>Bently Skunkworks - Locally made pottery</title>
  </head>
  <body class="bg-white">
    <main class="text-center">
      <section id="jumbotron">
        <nav class="navbar">
          <div class="container-fluid">
            <a class="navbar-brand text-dark" href="#"> Bently Skunkworks </a>
          </div>
        </nav>
        <div class="h-100 w-100 d-flex justify-content-center">
          <h1 class="text-dark mt-5">
            Quality Handmade Pottery from Fort Myers Florida
          </h1>
        </div>
      </section>
      <section class="container-fluid mt-3">
        <h2>Featured Items</h2>
        <div
          id="carouselExampleDark"
          class="carousel carousel-dark slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-inner" id="carouselDiv"></div>

          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>
      <section
        id="cardSection"
        class="containter-fluid d-flex justify-content-evenly flex-wrap"
      >
        <div class="card m-3 shadow" style="width: 18rem">
          <img src="./assets/img/BSWB1.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Flower/Bansai Pots</h5>
            <p class="card-text">Quirky fun pots made for plants or Bonsai</p>
            <a
              class="btn btn-info"
              data-title="Flower/Bansai Pots"
              data-category="BP"
              >Explore Pots</a
            >
          </div>
        </div>
        <div class="card m-3 shadow" style="width: 18rem">
          <img src="./assets/img/BSWM1.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Drinking Vessels</h5>
            <p class="card-text">Is it a mug...or a Tankard?</p>
            <a class="btn btn-info" data-title="Mugs" data-category="MU"
              >Explore Mugs</a
            >
          </div>
        </div>
        <div class="card m-3 shadow" style="width: 18rem">
          <img src="./assets/img/BSWO1.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Other</h5>
            <p class="card-text">
              well...some stuff just doesn't fit in a category of its own
            </p>
            <a class="btn btn-info" data-title="Other Stuff" data-category="IN"
              >Go somewhere</a
            >
          </div>
        </div>
      </section>
      <section
        id="aboutSection"
        class="d-flex align-items-center justify-content-center mx-auto container-fluid"
      >
        <div id="aboutContent" class="my-2 col-md-6 col-sm-10 p-2">
          <p>
            The Skunkworks were born due to a budding of a professional shop in
            Dallas Texas. The purpose is to allow a creative culprit an outlet
            in clay. Bently Skunkworks is a complete shop with a Skutt electric
            kiln and Shimpo wheel. Here we are creating products using
            traditional methods and raw materials. However the design and
            finished products come from a woodworkers mind. Utilizing little
            guidance from seasoned potters, we hope you find our wares
            refreshing, useful and beautiful additions to your home.
          </p>
        </div>
      </section>
      <section class="footer">
        <p>Copyright 2021 - Bently Skunkworks</p>
      </section>
    </main>
    <div
      id="modalSection"
      class="position-fixed top-0 start-0 vw-100 h-100 custom-bg text-white"
    >
      <div
        id="modalDiv"
        class="mx-auto my-5 w-75 h-75 bg-white text-dark border rounded"
      >
        <h1 class="text-center">Title</h1>
        <ul id="itemsList" class="m-3 p-3"></ul>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
      crossorigin="anonymous"
    ></script>
    <script>
      let itemDB = [];

      class Item {
        constructor(title, url, sku, mainImage, price) {
          this.sku = sku;
          this.title = title;
          this.mainImage = mainImage;
          this.url = url;
          this.price = price;
        }
      }

      const getDB = async () => {
        let data = '<?php echo $data; ?>';
        let data_parsed = JSON.parse(data);
        itemDB = [];

        const itemArray = data_parsed.results;
        for (item of itemArray) {
          const { title, url, sku, MainImage, price } = item;
          itemDB.push(new Item(title, url, sku, MainImage.url_170x135, price));
        }
        populateFeatured(itemDB);
        return itemDB;
      };

      // .then((data) => {
      //   return data;
      // })
      // .then((parsedItems) => {
      //   populateFeatured(parsedItems);
      //   items = parsedItems;
      // });

      const populateFeatured = (items) => {
        let featuredRemaining = 3;
        if (items) {
          const carouselDiv = document.getElementById("carouselDiv");

          items.forEach((item) => {
            if (featuredRemaining) {
              const rand = Math.random();
              if (rand > 0.5) {
                const newEl = document.createElement("div");
                newEl.classList.add("carousel-item");

                if (carouselDiv.childElementCount == 0) {
                  newEl.classList.add("active");
                }

                newEl.innerHTML = `
                  <img src=${item.mainImage} class="img-fluid"></img>
                    <h2>${item.title}</h2>`;

                carouselDiv.appendChild(newEl);
                featuredRemaining--;
              }
            }
          });
        }
      };
      getDB();
      populateFeatured(itemDB);
    </script>
    <script src="./assets/js/modal.js"></script>
  </body>
</html>
