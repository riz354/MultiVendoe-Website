<?php

namespace App\DataTables;

use App\Models\Section;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SectionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('name', function($section){
                return $section->name;
            })
            ->editColumn('status', function($section){
                return $section->status ==1 ? 'active': 'inactive';
            })
            ->editColumn('created_at', function($section){
                return $section->created_at;
            })
            ->editColumn('updated_at', function($section){
                return $section->updated_at;
            })
            ->editColumn('actions', function($section){
                return '<a href="' . route('admin.catelogue.section.edit', ['id' => $section->id]) . '"><i class="fa-solid fa-pen-to-square px-2"></i> </a> <a href="' . route('admin.catelogue.section.delete', ['id' => $section->id]) . '">   <i class="fa-regular fa-trash-can px-1"></i></a>';

            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Section $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('section-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->addClass('text-center')->addClass('text-nowrap')->title('Id'),
            Column::make('name')->title('Name'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_at')->title('Updated At'),
            Column::make('actions')->title('Action'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Section_' . date('YmdHis');
    }
}
