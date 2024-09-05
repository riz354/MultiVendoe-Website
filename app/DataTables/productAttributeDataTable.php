<?php

namespace App\DataTables;

use App\Models\Attribute;
use App\Models\productAttribute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class productAttributeDataTable extends DataTable
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
            ->editColumn('size', function ($attribute) {
                return $attribute->size ?? '-';
            })
            ->editColumn('price', function ($attribute) {
                return $attribute->price ?? '-';
            })
            ->editColumn('sku', function ($attribute) {
                return $attribute->sku ?? '-';
            })
            ->editColumn('stock', function ($attribute) {
                return $attribute->stock ?? '-';
            })
            ->editColumn('created_at', function ($attribute) {
                return $attribute->created_at;
            })
            ->editColumn('updated_at', function ($attribute) {
                return $attribute->updated_at;
            })
            ->editColumn('actions', function ($attribute) {
                return '<a href="' . route('admin.catelogue.categories.edit', ['id' => $attribute->id]) . '"><i class="fa-solid fa-pen-to-square px-2"></i> </a> <a href="' . route('admin.catelogue.categories.delete', ['id' => $attribute->id]) . '">   <i class="fa-regular fa-trash-can px-1"></i></a>';
            })
            ->editColumn('status', function ($attribute) {
                return $attribute->status == 1 ? 'active' : 'inactive';
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Attribute $model): QueryBuilder
    {
        $query =  $model->newQuery();

        if(request()->has('id')){
            $query = $query->where('product_id',request('id'));
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productattribute-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->scrollX(true)
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
            Column::make('price')->title('Parent Category'),
            Column::make('size')->title('Section'),
            Column::make('stock')->title('Discount'),
            Column::make('sku')->title('Description'),
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
        return 'productAttribute_' . date('YmdHis');
    }
}
