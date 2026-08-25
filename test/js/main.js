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
            <span>Số lượng: </span>
            <button class="descrease" data-id="${product.id}">-</button>
            <input id="quantity-product-${product.id}" type="number" value="1" min="1" max="${product.stock}">
            <button class="increase" data-id="${product.id}">+</button>
            <br>
            <button class="show-detail" data-id="${product.id}">Xem chi tiết sản phẩm</button>
            <button class="add-to-cart" data-id="${product.id}">Thêm vào giỏ hàng</button>
        </td>
        `
    })
}

productList.addEventListener('click', (event) => {
    if (event.target.classList.contains('add-to-cart')) {
        alert('Thêm vào giỏ hàng thanh công.')
        const productId = event.target.dataset.id;
        const quantityProduct = document.querySelector(`#quantity-product-${productId}`);
        addToCart(Number(productId), quantityProduct.value);

    }
    const productId = Number(event.target.dataset.id);
    if (event.target.classList.contains('increase')) {
        increaseQuantity(productId);
    }
    if (event.target.classList.contains('descrease')) {
        descreaseQuantity(productId);
    }
    // XEM CHI TIET SAN PHAM
    if (event.target.classList.contains('show-detail')) {
        showDetail(productId);
    }
})

function increaseQuantity(productId) {
    const quantityProduct = document.querySelector(`#quantity-product-${productId}`);
    let quantity = Number(quantityProduct.value);
    console.log(quantity);
    const product = products.find((item) => item.id === productId);
    if (quantity < product.stock) quantity++;
    quantityProduct.value = quantity;
}

function descreaseQuantity(productId) {
    const quantityProduct = document.querySelector(`#quantity-product-${productId}`);
    let quantity = Number(quantityProduct.value);
    if (quantity > 1) quantity--;
    quantityProduct.value = quantity;
}
// HAM XEM CHI TIET SAN PHAM
const modal = document.querySelector('.modal');
function showDetail(productId) {
    const detailProduct = document.querySelector("#detail-product");

    const product = products.find((item) =>
        item.id === productId
    )
    detailProduct.innerHTML = `
    <image src="${product.image}"></image>
    <h3>${product.name}</h3>
    <p>${product.chip}</p>
    <p>${product.storage}</p>
    <p><b>${product.price.toLocaleString("vi-VN")}</b></p>
    <button class="descrease" data-id="${productId}">-</button>
    <input id="modal-quantity-product-${productId}" type="number" value="1" min="1" max="${product.stock}">
    <button class="increase" data-id="${productId}">+</button>
    <br>
    <button class="add-to-cart" data-id="${productId}">Thêm vào giỏ hàng</button>
    `
    modal.classList.add('active');
}

//XU LI EVENT TRONG MODAL
modal.addEventListener('click', (event) => {
    const productId = Number(event.target.dataset.id);
    if (event.target.classList.contains('increase')) increaseModalQuantity(Number(event.target.dataset.id));

    if (event.target.classList.contains('descrease')) descreaseModalQuantity(Number(event.target.dataset.id));

    const input = document.querySelector(`#modal-quantity-product-${productId}`);
    if (event.target.classList.contains('add-to-cart')) {
        alert('Thêm vào giỏ hàng thành công')
        addToCart(Number(event.target.dataset.id), input.value);
    }
})

function increaseModalQuantity(productId) {
    const modalQuantityProduct = document.querySelector(`#modal-quantity-product-${productId}`);
    const product = products.find((item) => {
        return item.id === productId;
    })
    let quantity = Number(modalQuantityProduct.value);
    if (quantity < product.stock) quantity++;
    modalQuantityProduct.value = quantity;
}

function descreaseModalQuantity(productId) {
    const modalQuantityProduct = document.querySelector(`#modal-quantity-product-${productId}`);
    let quantity = Number(modalQuantityProduct.value);
    if (quantity > 1) quantity--;
    modalQuantityProduct.value = quantity;
}
//TAT XEM CHI TIET
const closeModal = document.querySelector('#close-modal');
modal.addEventListener('click', (event) => {
    if (event.target == modal)
        modal.classList.remove('active');
})
closeModal.addEventListener('click', () => modal.classList.remove('active'))


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
