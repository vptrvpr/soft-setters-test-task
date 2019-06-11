<template>
    <div class="vue-main">

        <div id="wrapper">
            <sidebar-component></sidebar-component>

            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">


                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                    </nav>


                    <div class="container-fluid">

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Авторы</h1>
                            <!--                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i-->
                            <!--                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                        </div>

                        <div class="row">


                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">

                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Список</h6>

                                    </div>

                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Имя</th>
                                                <th scope="col">Фамилия</th>
                                                <th scope="col">Отчество</th>
                                                <th scope="col">Страна</th>
                                                <th scope="col">Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(author,index) in authors">
                                                <th scope="row">{{author.name}}</th>
                                                <td>{{author.surname}}</td>
                                                <td>{{author.patronymic}}</td>
                                                <td>{{author.country}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-circle color-white"
                                                            data-toggle="modal"
                                                            :data-target="'.bd-example-modal-lg'+author.id"><i
                                                        class="far fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-circle color-white"
                                                            @click="deleteAuthor(author.id)">
                                                        <i class="fas fa-trash-alt"></i></button>
                                                </td>

                                                <div :class="'modal fade bd-example-modal-lg'+author.id" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Редиктирование - {{author.name}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <input type="text" v-model="author.name"
                                                                           class="form-control"
                                                                           placeholder="Имя">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" v-model="author.surname"
                                                                           class="form-control"
                                                                           placeholder="Фамилия">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" v-model="author.patronymic"
                                                                           class="form-control"
                                                                           placeholder="Отчество">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" v-model="author.country"
                                                                           class="form-control"
                                                                           placeholder="Страна">
                                                                </div>
                                                            </div>
                                                            <div class="alert alert-success" role="alert" v-if="successUpdateAuthor">
                                                                Saved successfully
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                        @click="updateAuthor(index)">Save changes
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Новый автор</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" v-model="newAuthor.name" class="form-control"
                                                   placeholder="Имя">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" v-model="newAuthor.surname" class="form-control"
                                                   placeholder="Фамилия">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" v-model="newAuthor.patronymic" class="form-control"
                                                   placeholder="Отчество">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" v-model="newAuthor.country" class="form-control"
                                                   placeholder="Страна">
                                        </div>
                                        <div class="alert alert-success" role="alert" v-if="successCreateAuthor">
                                            Saved successfully
                                        </div>
                                        <button type="button" class="btn btn-primary" @click="createAuthor()">Создать
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                authors: {},
                newAuthor: {
                    name: '',
                    surname: '',
                    patronymic: '',
                    country: ''
                },
                successCreateAuthor: false,
                successUpdateAuthor: false
            }
        },
        mounted() {
            this.getAuthors();
        },
        methods: {
            /**
             * Выбрать всех авторов
             */
            getAuthors: function () {
                axios( {
                    method: 'get',
                    url: '/author/get',
                } ).then( ( response ) => {
                    this.authors = response.data;
                } );
            },


            /**
             * Создание нового автора
             */
            createAuthor: function () {
                axios( {
                    method: 'post',
                    url: '/author/create',
                    data: { author: this.newAuthor }
                } ).then( ( response ) => {
                    this.newAuthor = {
                        name: '',
                        surname: '',
                        patronymic: '',
                        country: ''
                    };

                    this.successCreateAuthor = true;

                    var app = this;
                    setTimeout(function(){
                        app.successCreateAuthor = false;
                    }, 3000);

                    this.getAuthors();
                } );
            },


            /**
             * Редактирование нового автора
             */
            updateAuthor: function ( index ) {
                axios( {
                    method: 'post',
                    url: '/author/edit/' + this.authors[ index ].id,
                    data: { author: this.authors[ index ] }
                } ).then( ( response ) => {
                    this.getAuthors();

                    this.successUpdateAuthor = true;

                    var app = this;
                    setTimeout(function(){
                        app.successUpdateAuthor = false;
                    }, 3000);
                } );
            },


            /**
             * Удаление автора
             */
            deleteAuthor: function ( id ) {
                axios( {
                    method: 'delete',
                    url: '/author/delete/' + id
                } ).then( ( response ) => {
                    this.getAuthors();
                } );
            }
        }
    }
</script>
