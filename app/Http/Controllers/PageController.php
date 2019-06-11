<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Главная
     */
    public function index()
    {
        return redirect('/author');
    }


    /**
     * Авторы
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function author()
    {
        return view('pages.author');
    }

    /**
     * Книги
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function book()
    {
        $authors = Author::all();

        return view('pages.book',compact('authors'));
    }
}
