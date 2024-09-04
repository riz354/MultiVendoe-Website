<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->editColumn('section_id', function ($product) {
                return $product->section->name ?? '-';
            })
            ->editColumn('category_id', function ($product) {
                return $product->category->category_name ?? '-';
            })
            ->editColumn('brand_id', function ($product) {
                return $product->brand->name ?? '-';
            })
            // ->editColumn('vendor_id', function ($product) {
            //     $admin = $product->admin->where('vendor_id',$product->vendor_id)->first();
            //     return $admin ? $admin->name : '-';
            // })
            ->editColumn('vendor_id', function ($product) {
                if ($product->admin) { // Check if the relationship is loaded
                    $admin = $product->admin->where('vendor_id', $product->vendor_id)->first();
                    return $admin ? $admin->name : '-';
                }
                return '-'; // If admin is null, return '-'
            })

            ->editColumn('admin_type', function ($product) {
                return $product->admin_type ?? '-';
            })
            ->editColumn('product_name', function ($product) {
                return $product->product_name ?? '-';
            })

            ->editColumn('product_code', function ($product) {
                return $product->product_code ?? '-';
            })
            ->editColumn('product_color', function ($product) {
                return $product->product_color;
            })
            ->editColumn('product_price', function ($product) {
                return $product->product_color;
            })
            ->editColumn('product_discount', function ($product) {
                return $product->product_color;
            })
            ->editColumn('product_weight', function ($product) {
                return $product->product_color;
            })
            ->editColumn('product_image', function ($product) {
                return $product->product_color;
            })
            ->editColumn('description', function ($product) {
                return $product->product_color;
            })
            ->editColumn('meta_title', function ($product) {
                return $product->product_color;
            })
            ->editColumn('is_featured', function ($product) {
                return $product->product_color;
            })
            ->editColumn('meta_description', function ($product) {
                return $product->product_color;
            })
            ->editColumn('meta_keywords', function ($product) {
                return $product->product_color;
            })
            ->editColumn('updated_at', function ($product) {
                return $product->updated_at;
            })
            ->editColumn('created_at', function ($product) {
                return $product->created_at;
            })
            ->editColumn('actions', function ($product) {
                return '<a href="' . route('admin.catelogue.categories.edit', ['id' => $product->id]) . '"><i class="fa-solid fa-pen-to-square px-2"></i> </a> <a href="' . route('admin.catelogue.categories.delete', ['id' => $product->id]) . '">   <i class="fa-regular fa-trash-can px-1"></i></a>';
            })
            ->editColumn('status', function ($product) {
                return $product->status == 1 ? 'active' : 'inactive';
            })


            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->scrollX(true)
                    ->minifiedAjax()
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

            Column::make('section_id')->title('Section'),
            Column::make('category_id')->title('Category'),
            Column::make('brand_id')->title('Brand'),
            Column::make('vendor_id')->title('Vendor'),
            Column::make('admin_type')->title('Admin Type'),
            Column::make('product_name')->title('Product Name'),
            Column::make('product_code')->title('Product Code'),
            Column::make('product_color')->title('Product Color'),
            Column::make('product_price')->title('Product Price'),
            Column::make('product_discount')->title('Product Discount'),
            Column::make('product_weight')->title('Product WEight'),
            Column::make('product_image')->title('Product Image'),
            Column::make('description')->title('Product DEscription'),
            Column::make('meta_title')->title('Meta Title'),
            Column::make('is_featured')->title('is Featured'),
            Column::make('meta_description')->title('Meta Description'),
            Column::make('meta_keywords')->title('Meta Keywords'),
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
        return 'Product_' . date('YmdHis');
    }
}
