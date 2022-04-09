class Item {
    constructor(title, url, sku, mainImage, price) {
        this.sku = sku;
        this.title = title;
        this.mainImage = mainImage;
        this.url = url
        this.price = price
    }
}

module.exports = Item;