
let items;

function getItems() {
  return fetch('/api/items', {
    headers: {
      'Content-Type': 'application/json'
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
  })
  .then(response => {
    if (response.ok) {
      return response.json()
    }
  })
}

getItems()
  .then(data => {
    return data
  })
  .then(parsedItems => {
    populateFeatured(parsedItems)
    items = parsedItems;
  })

  const populateFeatured = (items) => {
    let featuredRemaining = 3
    if (items) {
      const carouselDiv = document.getElementById('carouselDiv');

      items.forEach(item => {
        if (featuredRemaining) {
          const rand = Math.random();
          if (rand > 0.5){
            const newEl = document.createElement('div');
            newEl.classList.add('carousel-item')

            if (carouselDiv.childElementCount == 0) {
              newEl.classList.add('active')
            }

            newEl.innerHTML = `
            <img src=${item.mainImage} class="img-fluid"></img>
              <h2>${item.title}</h2>`

            carouselDiv.appendChild(newEl);
            featuredRemaining--
          }
        }
      })
    }
  }