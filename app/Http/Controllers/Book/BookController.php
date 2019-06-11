<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Выбрать все книги
     *
     * @return Book[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $books = Book::with(['author'])->get();

        return $books;
    }


    /**
     * Создание новой книги
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $bookInfoRequest =  $request->get('book');

        $newBook = new Book();

        $newBook->name = $bookInfoRequest['name'];
        $newBook->author_id = $bookInfoRequest['author_id'];
        $newBook->quantity_pages = $bookInfoRequest['quantity_pages'];
        $newBook->date_of_issue = Carbon::create($bookInfoRequest['date_of_issue']);
        $newBook->publisher = $bookInfoRequest['publisher'];
        $newBook->cover_type = $bookInfoRequest['cover_type'];
        $newBook->save();
    }


    /**
     * @param         $id
     * @param Request $request
     */
    public function edit($id,Request $request)
    {
        $bookInfoRequest =  $request->get('author');

        $editAuthor = Book::where('id',$id)->first();

        $editAuthor->name = $bookInfoRequest['name'];
        $editAuthor->author_id = $bookInfoRequest['author_id'];
        $editAuthor->quantity_pages = $bookInfoRequest['quantity_pages'];
        $editAuthor->date_of_issue = Carbon::create($bookInfoRequest['date_of_issue']);
        $editAuthor->publisher = $bookInfoRequest['publisher'];
        $editAuthor->cover_type = $bookInfoRequest['cover_type'];
        $editAuthor->save();
    }


    /**
     * @param $id
     */
    public function delete($id)
    {
        Book::where('id',$id)->delete();
    }
}
