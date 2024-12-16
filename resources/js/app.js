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
            <td style="width: 120px;">
                <button class="btn btn-sm cart-minus">-</button>
                ${items[index].quantity} шт.
                <button class="btn btn-sm cart-plus">+</button>
            </td>
            <td>${items[index].price * items[index].quantity} руб.</td>
            <td style="width: 50px;">
                <button class="btn btn-danger btn-sm remove-cart">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" fill="white" viewBox="0 0 24 24">
<path d="M 10 2 L 9 3 L 3 3 L 3 5 L 21 5 L 21 3 L 15 3 L 14 2 L 10 2 z M 4.3652344 7 L 5.8925781 20.263672 C 6.0245781 21.253672 6.877 22 7.875 22 L 16.123047 22 C 17.121047 22 17.974422 21.254859 18.107422 20.255859 L 19.634766 7 L 4.3652344 7 z"></path>
</svg>
                </button>
            </td>
        `;
        modal.append(tr);

        ids.push(index);
    }

    if(!$('#staticBackdrop').hasClass('show'))
        $('#staticBackdrop').modal('toggle');

    // setStorage(ids);
};
const updateCart = items => {
    const table = document.querySelector('.table.cart tbody');

    if(!table) {
        return;
    }

    table.innerHTML = '';

    if(!Object.keys(items).length) {
        // setStorage([]);
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

    // setStorage(ids);
};

const getStorage = async () => {
    const req = await fetch('/cart/get');
    const res = await req.json();
    return res;
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
document.addEventListener('DOMContentLoaded', async () => {
    const storage = await getStorage();
    for (const index in storage) {
        getElementButton(index).textContent = 'Добавлено';
    }
});
// To do исправить в корзине
document.querySelectorAll('[action="https://netmeta.ru/cart/remove"]').forEach(element => {
    element.addEventListener('submit', () => {
        const id = element.querySelector('[name="product_id"]')?.value;
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
    if(event.target.closest('.remove-cart')) {
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
