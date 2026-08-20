import { products } from "./products.js";
import { categories } from "./products.js";

const productList = document.querySelector("#product-list");

products.forEach((product, index) => {
    if (index % 3 == 0) {
        productList.innerHTML += `<tr id="row-${index}"></tr>`;
    }
    const row = document.querySelector(`#row-${index - index % 3}`);
    row.innerHTML += `
    <td>
        <img src="${product.image}">
        <h3>
            ${product.name}
        </h3>
        <p>${product.chip}</p>
        <p>${product.storage}<p>
        <p><b>${product.price}</b></p>
    </td>
    `;
})

const productPriceTable = document.querySelector(("#product-price-table"));
productPriceTable.innerHTML += `<tr>
                <th>Tên</th>
                <th>RAM</th>
                <th>Bộ nhớ</th>
                <th>Giá</th>
            </tr>`;
products.forEach((product) => {
    productPriceTable.innerHTML += `
    <tr>
        <td>${product.name}</td>
        <td>${product.ram}</td>
        <td>${product.storage}</td>
        <td>${product.price.toLocaleString('vi-VN')}</td>
    </tr>
    `
})

const categoriesName = document.querySelector('#categories-name');
categories.forEach((category) => {
    categoriesName.innerHTML += `
    <li>${category}</li>
    `
})
