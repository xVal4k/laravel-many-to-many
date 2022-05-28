const { default: Axios } = require('axios');

require('./bootstrap');

const slugButton = document.querySelector('.slug_btn');
if (slugButton) {
    slugButton.addEventListener('click', function() {
        const slug = document.getElementById('slug');
        const title = document.getElementById('title').value;

        Axios.post('/admin/get-slug', {
            baseString: title,
        })
            .then(function (response) {
                slug.value = response.data.slug;
            })
    });
}

const modalDelete = document.getElementById('modal-delete');
if (modalDelete) {
    document.querySelectorAll('.del_btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.closest('div').dataset.id;
            const modalForm = modalDelete.querySelector('form');
            const strAction = modalForm.dataset.base.replace('***', id);
            modalForm.action = strAction;
        })
    });

    const btnModalClose = document.querySelector('.md_close_btn');
    btnModalClose.addEventListener('click', function() {
        modalForm.action = '';
    });
}
