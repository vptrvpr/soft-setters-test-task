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
                            <h1 class="h3 mb-0 text-gray-800">Книги</h1>
                            <a href="/books-export/excel" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Экспорт в Excel</a>
                            <!--                            <img src="img/oval.svg">-->

                        </div>

                        <div class="row">


                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">

                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Список </h6>


                                    </div>

                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Название</th>
                                                <th scope="col">Автор</th>
                                                <th scope="col">Кол-во страниц</th>
                                                <th scope="col">Год выпуска</th>
                                                <th scope="col">Издатель</th>
                                                <th scope="col">Тип обложки</th>
                                                <th scope="col">Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(book,index) in books">
                                                <th scope="row">{{book.name}}</th>
                                                <td>{{book.author.name}} {{book.author.surname}}</td>
                                                <td>{{book.quantity_pages}}</td>
                                                <td>{{new Date(book.date_of_issue).getFullYear()}}</td>
                                                <td>{{book.publisher}}</td>
                                                <td>{{book.cover_type}}</td>

                                                <td>
                                                    <button type="button" class="btn btn-success btn-circle color-white"
                                                            data-toggle="modal"
                                                            :data-target="'.bd-example-modal-lg'+book.id"><i
                                                        class="far fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-circle color-white"
                                                            @click="deleteBook(book.id)">
                                                        <i class="fas fa-trash-alt"></i></button>
                                                </td>

                                                <div :class="'modal fade bd-example-modal-lg'+book.id" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Редиктирование - {{book.name}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <input type="text" v-model="book.name"
                                                                           class="form-control"
                                                                           placeholder="Название">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Выберите
                                                                        автора</label>
                                                                    <select class="form-control"
                                                                            v-model="book.author_id"
                                                                            id="exampleFormControlSelect1">
                                                                        <option v-for="author in authors"
                                                                                :value="author.id">{{author.name}}
                                                                            {{author.surname}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" v-model="book.quantity_pages"
                                                                           class="form-control"
                                                                           placeholder="Кол-во страниц">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Дата
                                                                        выпуска</label>
                                                                    <datepicker
                                                                        v-model="book.date_of_issue"></datepicker>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" v-model="book.publisher"
                                                                           class="form-control"
                                                                           placeholder="Издатель">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect2">Выберите тип
                                                                        обложки</label>
                                                                    <select class="form-control"
                                                                            v-model="book.cover_type"
                                                                            id="exampleFormControlSelect2">
                                                                        <option v-for="coverType in coverTypes"
                                                                                :value="coverType.type">
                                                                            {{coverType.type}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="alert alert-success" role="alert"
                                                                 v-if="successUpdateBook">
                                                                Saved successfully
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                        @click="updateBook(index)">Save changes
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
                                            <input type="text" v-model="newBook.name" class="form-control"
                                                   placeholder="Название">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Выберите автора</label>
                                            <select class="form-control" v-model="newBook.author_id"
                                                    id="exampleFormControlSelect1">
                                                <option v-for="author in authors" :value="author.id">{{author.name}}
                                                    {{author.surname}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" v-model="newBook.quantity_pages" class="form-control"
                                                   placeholder="Кол-во страниц">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Дата выпуска</label>
                                            <datepicker v-model="newBook.date_of_issue"></datepicker>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" v-model="newBook.publisher" class="form-control"
                                                   placeholder="Издатель">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Выберите тип обложки</label>
                                            <select class="form-control" v-model="newBook.cover_type"
                                                    id="exampleFormControlSelect2">
                                                <option v-for="coverType in coverTypes" :value="coverType.type">
                                                    {{coverType.type}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="alert alert-success" role="alert" v-if="successCreateBook">
                                            Saved successfully
                                        </div>
                                        <button type="button" class="btn btn-primary" @click="createBook()">Создать
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
        props: [ 'authors' ],
        data() {
            return {
                books: {},
                newBook: {
                    name: '',
                    author_id: '',
                    quantity_pages: '',
                    date_of_issue: '',
                    publisher: '',
                    cover_type: '',
                },
                successCreateBook: false,
                successUpdateBook: false,
                coverTypes: [
                    { type: 'Твердая' },
                    { type: 'Мягкая' },

                ]

            }
        },
        mounted() {
            this.getBooks();
        },
        methods: {
            /**
             * Выбрать всех книги
             */
            getBooks: function () {
                axios( {
                    method: 'get',
                    url: '/book/get',
                } ).then( ( response ) => {
                    this.books = response.data;
                } );
            },


            /**
             * Создание нового автора
             */
            createBook: function () {
                axios( {
                    method: 'post',
                    url: '/book/create',
                    data: { book: this.newBook }
                } ).then( ( response ) => {
                    this.newBook = {
                        name: '',
                        author_id: '',
                        quantity_pages: '',
                        date_of_issue: '',
                        publisher: '',
                        cover_type: '',
                    };

                    this.successCreateBook = true;

                    var app = this;
                    setTimeout( function () {
                        app.successCreateBook = false;
                    }, 3000 );

                    this.getBooks();
                } );
            },

            /**
             * Редактирование нового автора
             * @param index
             */
            updateBook: function ( index ) {
                axios( {
                    method: 'post',
                    url: '/book/edit/' + this.books[ index ].id,
                    data: { author: this.books[ index ] }
                } ).then( ( response ) => {
                    this.getBooks();

                    this.successUpdateBook = true;

                    var app = this;
                    setTimeout( function () {
                        app.successUpdateBook = false;
                    }, 3000 );
                } ).catch( function ( error ) {
                    console.log( error );
                } );
            },


            /**
             * Удаление книги
             */
            deleteBook: function ( id ) {
                axios( {
                    method: 'delete',
                    url: '/book/delete/' + id
                } ).then( ( response ) => {
                    this.getBooks();
                } );
            }
        }
    }
</script>
