import { products } from "./products.js";
import { categories } from "./products.js";
import { addToCart } from "./cart.js";

const productList = document.querySelector("#product-list");
const search = document.querySelector("#search");
const sortBy = document.querySelector('#sort-by');
const checkOut = document.querySelector('#check-out');

function renderProducts() {
    let newProducts = [...products];

    if (search.value !== "") {
        newProducts = [...newProducts].filter((product) => {
            return product.name.toLowerCase().includes(search.value.trim().toLowerCase());
        })
    }
    if (sortBy.value !== "") {
        if (sortBy.value === "name-inc" || sortBy.value === "") newProducts.sort((a, b) => a.name.localeCompare(b.name));
        else if (sortBy.value === "name-des") newProducts.sort((a, b) => b.name.localeCompare(a.name));
        else if (sortBy.value === 'price-inc') newProducts.sort((a, b) => a.price - b.price);
        else if (sortBy.value === 'price-des') newProducts.sort((a, b) => b.price - a.price);
    }
    displayProducts(newProducts);
}
search.addEventListener("input", () => {
    renderProducts();
})

sortBy.addEventListener('change', () => {
    renderProducts();
})
renderProducts();

// HIEN THI BANG GIA
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

// HIEN THI SANH SACH DANH MUC
const categoriesName = document.querySelector('#categories-name');
categories.forEach((category) => {
    categoriesName.innerHTML += `
    <li>${category}</li>
    `
})

// HIEN THI SAN PHAM

function displayProducts(products) {
    productList.innerHTML = "";
    products.forEach((product, index) => {
        if (index % 3 == 0) productList.innerHTML += `<tr id="row-${index}"></tr>`;

        const row = document.querySelector(`#row-${index - index % 3}`);
        row.innerHTML += `
        <td>
            <image src="${product.image}"></image>
            <h3>${product.name}</h3>
            <p>${product.chip}</p>
            <p>${product.storage}</p>
            <p><b>${product.price.toLocaleString('vi-VN')}</b></p>
            <button class="add-to-cart" data-id="${product.id}">Thêm vào giỏ hàng</button>
        </td>
        `
    })
}

productList.addEventListener('click', (event) => {
    if (event.target.classList.contains('add-to-cart')) {
        alert('Thêm giỏ hàng thanh công.')
        addToCart(Number(event.target.dataset.id));

    }
})

//Validate Contact Form
checkOut.addEventListener("submit", () => {
    event.preventDefault();
    const name = document.querySelector('#name').value.trim();
    const email = document.querySelector('#email').value.trim();
    const phone = document.querySelector('#phone').value.trim();
    const address = document.querySelector('#address').value.trim();
    clearErrors();
    if (name === "") {
        showError('name-error', 'Họ và tên không đuọc để trống');
    }
    if (email === "") {
        showError('email-error', 'Email không được để trống');
    }
    else if (!validateEmail(email)) {
        showError('email-error', 'Email không hợp lệ')
    }
    if (phone === "") {
        showError('phone-error', 'Số điện thoại không được để trống');
    }
    if (address === "") {
        showError('address-error', 'Địa chỉ không được để trống');
    }
})
function showError(id, mess) {
    document.querySelector(`#${id}`).textContent = mess;
}

function clearErrors() {
    document.querySelectorAll('.error').forEach((item) => {
        item.innerHTML = "";
    })
}
function validateEmail(email) {
    if (email.length < 6) return false;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
