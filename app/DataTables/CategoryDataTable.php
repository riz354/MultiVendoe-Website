<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('category_name', function ($section) {
                return $section->category_name ?? '-';
            })
            ->editColumn('discount', function ($section) {
                return $section->category_discount ?? '-';
            })
            ->editColumn('description', function ($section) {
                return $section->description ?? '-';
            })
            ->editColumn('url', function ($section) {
                return $section->url ?? '-';
            })
            ->editColumn('meta_title', function ($section) {
                return $section->meta_title ?? '-';
            })
            ->editColumn('meta_description', function ($section) {
                return $section->meta_description ?? '-';
            })
            ->editColumn('meta_keywords', function ($section) {
                return $section->meta_keywords ?? '-';
            })
            ->editColumn('created_at', function ($section) {
                return $section->created_at;
            })
            ->editColumn('updated_at', function ($section) {
                return $section->updated_at;
            })
            ->editColumn('actions', function ($section) {
                return '<a href="' . route('admin.catelogue.categories.edit', ['id' => $section->id]) . '"><i class="fa-solid fa-pen-to-square px-2"></i> </a> <a href="' . route('admin.catelogue.categories.delete', ['id' => $section->id]) . '">   <i class="fa-regular fa-trash-can px-1"></i></a>';
            })
            ->editColumn('status', function ($section) {
                return $section->status == 1 ? 'active' : 'inactive';
            })
            ->editColumn('parent_category', function ($category) {
                if ($category->parent_id == 0) {
                    return 'Root';
                } else {
                    $parentCategory = $category->where('id', $category->parent_id)->first();
                    return $parentCategory ? $parentCategory->category_name : '-';
                }
            })
            ->editColumn('section', function ($category) {
                return $category->section->name ?? '-';
            })

            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
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
            Column::make('category_name')->title('Name'),
            Column::make('parent_category')->title('Parent Category'),
            Column::make('section')->title('Section'),


            Column::make('discount')->title('Discount'),
            Column::make('description')->title('Description'),
            Column::make('url')->title('Url'),
            Column::make('meta_title')->title('Meta Title'),
            Column::make('meta_description')->title('Meta Description'),
            Column::make('meta_keywords')->title('Meta Keywords'),
            Column::make('status')->title('Status'),
            Column::make('updated_at')->title('Updated At'),
            Column::make('actions')->title('Action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
