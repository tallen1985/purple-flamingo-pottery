const express = require('express')
const Item = require('./lib/item')
const fetch = require('node-fetch')

const app = express()
const PORT = process.env.PORT || 3001

const etsyAPI = 'r645z2pvk8ptxcr6dz8y0oqp'

let itemDB = [];

const getDB = async () => {
    itemDB = [];
    try {
        const response = await fetch(`https://openapi.etsy.com/v2/shops/BentlyskunkworksShop/listings/active?method=GET&api_key=${etsyAPI}&fields=title,price,url&limit=100&includes=MainImage`)

        const data = await response.json();
        const itemArray = data.results;
        for (item of itemArray ){
            const {title, url, sku, MainImage, price} = item;
            itemDB.push(new Item(title, url, sku, MainImage.url_170x135, price))
        }
       return itemDB

    }
    catch (error) {
        console.log(error)
    }
}


app.use(express.json())

app.use(express.static('public'))

app.get('/api/items', (req, res) => {
    getDB().then(itemDB => res.status(200).send(itemDB));
    
})

app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`)
})