import { products } from "./products.js";


const productList = document.querySelector("#product-list");

products.forEach((product, index) => {
    if (index % 3 == 0) {
        productList.innerHTML += `<tr id="row-${index}"></tr>`;
    }
    const row = document.querySelector(`"#row-${index - index % 3}"`);
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
