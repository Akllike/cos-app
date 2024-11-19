import './bootstrap';
import 'bootstrap';
import toastr from 'toastr';

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

    let storage = localStorage.getItem('cart');
    if (storage) {
        storage = JSON.parse(storage);
    } else {
        storage = [];
    }

    storage.push(id);
    setStorage(storage);

    openModal(res);
};

const removeFromCart = async id => {
    const req = await fetch('/cart/remove', {
        method: 'post',
        body: JSON.stringify({
            product_id: id,
            _token: document.querySelector('[name="_token"]').value
        }),
        headers: {
            'content-type': 'application/json'
        }
    });
    const res = await req.text();

    removeStorage(id);

    document.querySelector(`tr[data-id="${id}"]`).remove();

    if(!document.querySelectorAll('.cart tbody tr').length) {
        const cartTable = document.querySelector('.cart');
        if(cartTable) {
            cartTable.outerHTML = `<p>Корзина пуста</p>`;
        }
    }
};

const openModal = items => {
    const modal = document.querySelector('#staticBackdrop #data-display');
    modal.innerHTML = '';
    for (const index in items) {
        const tr = document.createElement('tr');
        tr.setAttribute('data-id', index);
        tr.innerHTML = `
            <td>${items[index].name}</td>
            <td>${items[index].quantity} шт.</td>
            <td>${items[index].price * items[index].quantity} руб.</td>
            <td>
                <button class="btn btn-danger btn-sm remove-cart">Удалить</button>
            </td>
        `;
        modal.append(tr);
    }

    $('#staticBackdrop').modal('toggle');
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
        const id = element.closest('.card').getAttribute('data-id');
        addToCart(id);
    });
});
// удалить в корзине и в модалке
document.addEventListener('click', event => {
    if(event.target.classList.contains('remove-cart')) {
        const id = event.target.closest('tr').getAttribute('data-id');
        removeFromCart(id);
    }
});
