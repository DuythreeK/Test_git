import { products } from "./products.js";
const cartList = document.querySelector('#cart-list');
const cartTotal = document.querySelector('#cart-total');
const checkOut = document.querySelector('#check-out');

let cart = JSON.parse(localStorage.getItem("cart")) || [];

function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

//THEM VAO GIO HANG
export function addToCart(productId) {
    const product = products.find((item) => {
        return item.id === productId;
    })
    const cartItem = cart.find((item) => {
        return item.product.id === productId;
    })

    if (cartItem) {
        cartItem.quantity++;
    }
    else {
        cart.push({
            product: product,
            quantity: 1
        });
    }
    saveCart();
    renderCart();
}


//TANG SO LUONG
function increaseQuantity(productId) {
    const cartItem = cart.find((item) => {
        return item.product.id === productId;
    })
    cartItem.quantity++;
    saveCart();
    renderCart();
}

//GIAM SO LUONG
function decreaseQuantity(productId) {
    const cartItem = cart.find((item) => {
        return item.product.id === productId;
    })
    if (cartItem.quantity > 1) {
        cartItem.quantity--;
    }
    else removeFromCart(productId);
    saveCart();
    renderCart();
}

//LOAI BO KHOI GIO HANG
function removeFromCart(productId) {
    cart = cart.filter((item) => item.product.id !== productId);
    saveCart();
    renderCart();
}

//TONG TIEN
function updateTotal(total) {
    cartTotal.textContent = `${total.toLocaleString('vi-VN')} VNĐ`;
}

//HIEN THI GIO HANG
function renderCart() {
    cartList.innerHTML = "";
    console.log(cart);
    if (cart.length === 0) {
        cartList.innerHTML = `<p>Giỏ hàng đang trống</p>`;
        cartTotal.textContent = "0 VNĐ";
        return;
    }
    let total = 0;
    cart.forEach(item => {
        total += item.product.price * item.quantity;
        cartList.innerHTML += `
        <div id="cart-item">
            <h3>${item.product.name}</h3>
            <img src="${item.product.image}"></img>
            <p>${item.product.price.toLocaleString('vi-VN')}</p>
            <button class='descrease' data-id="${item.product.id}">-</button>
            <span>${item.quantity}</span>
            <button class='increase' data-id="${item.product.id}">+</button>
            <button class='remove' data-id="${item.product.id}">Xóa</button>
        </div>
        `
    });
    updateTotal(total);
}

//=================
//EVENT
//=================
if (cartList) {
    cartList.addEventListener('click', (event) => {
        if (event.target.classList.contains('increase')) {
            increaseQuantity(Number(event.target.dataset.id));
        }
        else if (event.target.classList.contains('descrease')) {
            decreaseQuantity(Number(event.target.dataset.id));
        }
        else if (event.target.classList.contains('remove')) {
            removeFromCart(Number(event.target.dataset.id));
        }
    })
    renderCart();
}

//Validate Contact Form
checkOut.addEventListener("submit", () => {
    event.preventDefault();
    const name = document.querySelector('#name').value.trim();
    const email = document.querySelector('#email').value.trim();
    const phone = document.querySelector('#phone').value.trim();
    const address = document.querySelector('#address').value.trim();
    clearErrors();

    let isValid = true;
    if (name === "") {
        showError('name-error', 'Họ và tên không đuọc để trống');
        isValid = false;
    }
    if (email === "") {
        showError('email-error', 'Email không được để trống');
        isValid = false;

    }
    else if (!validateEmail(email)) {
        showError('email-error', 'Email không hợp lệ')
        isValid = false;

    }
    if (phone === "") {
        showError('phone-error', 'Số điện thoại không được để trống');
        isValid = false;

    }
    if (address === "") {
        showError('address-error', 'Địa chỉ không được để trống');
        isValid = false;

    }

    if (isValid == true) {
        const order = {
            id: Date.now(),
            customer: {
                name,
                email,
                phone,
                address
            },
            items: cart,
            createAt: new Date().toISOString()
        }
        console.log(order);
        alert('Tạo đơn hàng thành công')
        localStorage.removeItem("cart");
        cart = [];
        renderCart();
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


