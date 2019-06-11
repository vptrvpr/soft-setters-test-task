<?php

namespace App\Excel\Exports;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Events\BeforeExport;

class BooksExport implements FromCollection,WithHeadings
{
    public static function beforeExport(BeforeExport $event)
    {
        return redirect()->back();
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Название',
            'Автор',
            'Кол-во страниц',
            'Дата выпуска',
            'Издатель'
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $books = Book::with(['author'])->get();

        $books = $this->collectArrayForExport($books);

        return $books;
    }


    /**
     * Конвертируем модель в нужный формат для экспорта
     *
     * @param Collection $collection
     *
     * @return Collection
     */
    public function collectArrayForExport(Collection $collection){
        $result = $collection->transform(function($item){
            $res['name'] = $item->name;
            $res['author'] = $item->author->name . ' ' . $item->author->surname . ' ' . $item->author->patronymic;
            $res['quantity_pages'] = $item->quantity_pages;
            $res['date_of_issue'] = $item->date_of_issue->year;
            $res['publisher'] = $item->publisher;
            return $res;
        });

        return $result;
    }

}
