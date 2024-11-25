import './bootstrap';
import 'bootstrap';
import toastr from 'toastr';
import ScrollReveal from "scrollreveal";

ScrollReveal().reveal('.container');

const addToCart = async (id, quantity) => {
    let data = {
        product_id: id,
        quantity: quantity
    };

    const req = await fetch('/cart/add', {
        method: 'post',
        body: JSON.stringify(data),
        headers: {
            'content-type': 'application/json'
        }
    });
    const res = await req.json();

    getElementButton(id).textContent = 'Добавлено';

    openModal(res);

    updateCart(res);
};

const removeFromCart = async (id, quantity = 0) => {
    const req = await fetch('/cart/remove', {
        method: 'post',
        body: JSON.stringify({
            product_id: id,
            _token: document.querySelector('[name="_token"]').value,
            quantity: quantity
        }),
        headers: {
            'content-type': 'application/json'
        }
    });
    const res = await req.json();

    openModal(res);

    updateCart(res);
};

const openModal = items => {
    const modal = document.querySelector('#staticBackdrop #data-display');
    if(!modal) {
        return;
    }
    modal.innerHTML = '';

    const ids = [];
    for (const index in items) {
        const tr = document.createElement('tr');
        tr.setAttribute('data-id', index);
        tr.innerHTML = `
            <td>${items[index].name}</td>
            <td>
                <button class="btn btn-sm cart-minus">-</button>
                ${items[index].quantity} шт.
                <button class="btn btn-sm cart-plus">+</button>
            </td>
            <td>${items[index].price * items[index].quantity} руб.</td>
            <td>
                <button class="btn btn-danger btn-sm remove-cart">Удалить</button>
            </td>
        `;
        modal.append(tr);

        ids.push(index);
    }

    if(!$('#staticBackdrop').hasClass('show'))
        $('#staticBackdrop').modal('toggle');

    setStorage(ids);
};
const updateCart = items => {
    const table = document.querySelector('.table.cart tbody');

    if(!table) {
        return;
    }

    table.innerHTML = '';

    if(!Object.keys(items).length) {
        setStorage([]);
        table.closest('.cart').outerHTML = `<p>Корзина пуста</p>`;
        return;
    }

    const ids = [];
    for (const index in items) {
        const tr = document.createElement('tr');
        tr.setAttribute('data-id', index);
        tr.innerHTML = `
            <td>${items[index].name}</td>
            <td>${items[index].price}</td>
            <td>
                <button class="btn btn-sm cart-minus">-</button>
                ${items[index].quantity} шт.
                <button class="btn btn-sm cart-plus">+</button>
            </td>
            <td>${items[index].price * items[index].quantity} руб.</td>
            <td>
                <button class="btn btn-danger btn-sm remove-cart">Удалить</button>
            </td>
        `;
        table.append(tr);
        ids.push(index);
    }

    setStorage(ids);
};

const getStorage = () => {
    let storage = localStorage.getItem('cart');
    if (storage) {
        storage = JSON.parse(storage);
    } else {
        storage = [];
    }

    return storage;
};
const setStorage = data => {
    localStorage.setItem('cart', JSON.stringify(data));
};
const removeStorage = id => {
    const storage = getStorage();
    const index = storage.findIndex(i => i == id);
    if (index) {
        storage.splice(index, 1);
        setStorage(storage);
    }
};
const getElementButton = id => {
    return document.querySelector(`[data-id="${id}"] .add-cart`) || {};
};

const quantityToggle = (type) => {
    const block = document.querySelector('.quantity-block');
    const currentValueBlock = block.querySelector('.quantity');

    let value = +currentValueBlock.textContent;
    if(type == 'plus') {
        value++;
    } else {
        value--;
        if(value <= 0) {
            value = 1;
        }
    }

    currentValueBlock.textContent = value;
};

// Слушатели
document.addEventListener('DOMContentLoaded', () => {
    const storage = getStorage();
    for (const item of storage) {
        getElementButton(item).textContent = 'Добавлено';
    }
});
// To do исправить в корзине
document.querySelectorAll('[action="https://netmeta.ru/cart/remove"]').forEach(element => {
    element.addEventListener('submit', () => {
        const id = element.querySelector('[name="product_id"]')?.value;
        removeStorage(id);
    });
});
// добавление в корзину
document.querySelectorAll('.add-cart').forEach(element => {
    element.addEventListener('click', () => {
        const dataIdEl = element.closest('[data-id]');
        const id = dataIdEl.getAttribute('data-id');

        // Ищем инпут с классом quantity
        let quantity = 1;

        if(dataIdEl.querySelector('.quantity')) {
            quantity = dataIdEl.querySelector('.quantity').textContent;
        }

        addToCart(id, quantity);
    });
});
// удалить в корзине и в модалке
document.addEventListener('click', event => {
    if(event.target.classList.contains('remove-cart')) {
        const id = event.target.closest('tr').getAttribute('data-id');
        removeFromCart(id);
    }
    if(event.target.classList.contains('cart-plus')) {
        const id = event.target.closest('tr').getAttribute('data-id');
        addToCart(id, 1);
    }
    if(event.target.classList.contains('cart-minus')) {
        const id = event.target.closest('tr').getAttribute('data-id');
        removeFromCart(id, 1);
    }
    if(event.target.classList.contains('quantity-plus')) {
        quantityToggle('plus');
    }
    if(event.target.classList.contains('quantity-minus')) {
        quantityToggle('minus');
    }
});
