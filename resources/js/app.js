/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 const { default: Axios } = require('axios');

 require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

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
