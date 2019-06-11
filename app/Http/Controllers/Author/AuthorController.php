<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{



    /**
     * Выбрать всех авторов
     *
     * @return Author[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $authors = Author::all();

        return $authors;
    }


    /**
     * Создание нового автора
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $authorInfoRequest =  $request->get('author');

        $newAuthor = new Author();

        $newAuthor->name = $authorInfoRequest['name'];
        $newAuthor->surname = $authorInfoRequest['surname'];
        $newAuthor->patronymic = $authorInfoRequest['patronymic'];
        $newAuthor->country = $authorInfoRequest['country'];
        $newAuthor->save();
    }


    /**
     * @param         $id
     * @param Request $request
     */
    public function edit($id,Request $request)
    {
        $authorInfoRequest =  $request->get('author');

        $editAuthor = Author::where('id',$id)->first();

        $editAuthor->name = $authorInfoRequest['name'];
        $editAuthor->surname = $authorInfoRequest['surname'];
        $editAuthor->patronymic = $authorInfoRequest['patronymic'];
        $editAuthor->country = $authorInfoRequest['country'];
        $editAuthor->save();
    }


    /**
     * @param $id
     */
    public function delete($id)
    {
        Author::where('id',$id)->delete();
    }
}
