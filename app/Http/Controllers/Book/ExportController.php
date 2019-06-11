<?php

namespace App\Http\Controllers\Book;

use App\Excel\Exports\BooksExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Экспорт книг в эксель
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToExcel()
    {
        return  Excel::download( new BooksExport, config( 'app.name_excel_file_export_books' ) . '.xlsx');
    }
}
