const btn = document.getElementsByClassName("btn");
const main = document.querySelector("main");
const modalBG = document.getElementById("modalSection");
const modal = document.getElementById("modalDiv");
const modalTitle = modal.firstElementChild;
const itemList = document.getElementById("itemsList");

modalBG.addEventListener("click", (e) => {
  if (e.target == modalBG) {
    modalBG.style.display = "none";
    const scrollY = document.body.style.top;
    document.body.style.position = "";
    document.body.style.top = "";
    window.scrollTo(0, parseInt(scrollY || "0") * -1);
  }
});

for (button of btn) {
  button.addEventListener("click", (e) => {
    if (itemDB) {
      const { title, category } = e.target.dataset;
      getModalHTML(title, category, itemDB);
      modalBG.style.display = "block";
      document.body.style.position = "fixed";
      document.body.style.top = `-${window.scrollY}px`;
    }
  });
}

const getModalHTML = (title, category, itemDB) => {
  filteredItems = itemDB.filter((item) => {
    itemCategory = item.sku[0].split("-")[0];
    return itemCategory === category;
  });
  modalTitle.textContent = title;
  itemList.innerHTML = "";
  for (item of filteredItems) {
    itemList.appendChild(addItem(item));
  }
};

const addItem = (item) => {
  const el = document.createElement("li");
  el.classList = "mx-auto p-3";

  const img = document.createElement("img");
  img.classList = "mx-auto";
  img.src = `${item.mainImage}`;
  el.appendChild(img);

  const div = document.createElement("div");

  const name = document.createElement("h3");
  name.textContent = item.title;
  div.appendChild(name);

  const price = document.createElement("p");
  price.textContent = `Price: $${item.price}`;
  div.appendChild(price);

  const button = document.createElement("a");
  button.href = item.url;
  button.classList = "btn btn-info";
  button.textContent = "More Info / Buy Now";

  div.appendChild(button);

  el.appendChild(div);

  return el;
};
