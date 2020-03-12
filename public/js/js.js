document.addEventListener('DOMContentLoaded', () => {
    fetch('/api/cartQty')
        .then((response) => response.json())
        .then((data) => {
            if (data.qty > 0) {
                creatCartQty(data.qty)
            }
        })
        .catch((error) => {
            console.log(error);
        });
});

function creatCartQty(qty) {
    const qtyEl = document.createElement('div');
    qtyEl.innerHTML = `${qty}`;
    qtyEl.className = 'cart_qty';
    document.querySelector('.cart').appendChild(qtyEl);
}

function updateCartQty(qty) {
    if (qty === 0) {
        document.querySelector('.cart_qty').remove();
    } else {
        document.querySelector('.cart_qty').innerHTML = `${qty}`;
    }
}

function newSession() {
    fetch('/api/newSession')
        .then(() => {
            document.location.href = '/';
        })
        .catch((err) => {
            console.log(err);
        })
}

const name = document.getElementById('name');
const feed = document.getElementById('feed');
const id = document.getElementById('feedback').dataset.id_good;
const btnOk = document.getElementById('ok');

function editEvent(elem) {
    elem.addEventListener('click', (evt) => {
        evt.preventDefault();
        const idFeed = evt.target.dataset.id_feed;
        fetch(`/api/edit/?id_feed=${idFeed}`)
            .then((response) => response.json())
            .then((data) => {
                name.value = data.name;
                feed.value = data.feed;
                btnOk.remove();
                let editBtn = document.getElementById('edit');
                if (editBtn == null) {
                    editBtn = document.createElement('button');
                    editBtn.setAttribute('id', 'edit');
                    editBtn.innerText = 'Редактировать';
                    feed.insertAdjacentElement('afterend', editBtn);
                    save(editBtn, elem, idFeed);
                }

            })
    })
}

function save(editBtn, elem, idFeed) {
    editBtn.addEventListener('click', (evt) => {
        fetch(`/api/save/?id_feed=${idFeed}`, {
            method: 'POST',
            body: JSON.stringify({
                name: name.value,
                feed: feed.value,
                headers: {
                    'Content-Type': 'application/json',
                },
            })
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status) {
                    evt.target;
                    editBtn.remove();
                    feed.insertAdjacentElement('afterend', btnOk);
                    elem.previousElementSibling.innerHTML =
                        `<span><strong>${name.value}</strong>: ${feed.value}</span>`;
                    name.value = '';
                    feed.value = '';
                }
            })
            .catch((err) => {
                console.log(err);
            })
    })
}

function addEvent(elem) {
    elem.addEventListener('click', (evt) => {
        /*TODO сделать проверку на пустую форму*/
        let id = evt.target.dataset.id_good;
        fetch('/api/add', {
            method: 'POST',
            body: JSON.stringify({
                name: name.value,
                feed: feed.value,
                id_good: id,
            }),
            headers: {
                'Content-type': 'application/json',
            },
        })
            .then((response) => response.json())
            .then((data) => {
                const feedElem = document.createElement('div');
                feedElem.innerHTML = `<span><strong>${name.value}</strong>: ${feed.value}</span>
                                          <a href="/" class="edit" data-id_feed="${data.id}" >[править]</a>
                                          <a href="/" class="del" data-id_feed="${data.id}">[X]</a>`;
                document.querySelector('.feedback_list').insertAdjacentElement('afterbegin', feedElem);
                name.value = '';
                feed.value = '';
                const editElem = document.querySelector('.edit');
                editEvent(editElem);
                const delElem = document.querySelector('.del');
                delEvent(delElem);

            })
            .catch((err) => {
                console.log(err);
            })
    })
}

function delEvent(elem) {
    elem.addEventListener('click', (evt) => {
        evt.preventDefault();
        const id_feed = elem.dataset.id_feed;
        fetch(`/api/delete/?id_feed=${id_feed}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.status) {
                    elem.parentElement.remove();
                }
            })
    })
}


