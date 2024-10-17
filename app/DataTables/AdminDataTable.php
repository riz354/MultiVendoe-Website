<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
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
            ->editColumn('email', function($section){
                return $section->email;
            })
            // ->editColumn('mobile', function($section){
            //     return $section->mobile;
            // })
            ->editColumn('permissions', function($role){
                if(isset($role->permissions)){
                    $permissions =  $role->roles->pluck('name')->toArray();
                    return implode(',',$permissions);
                }else{
                    return '-';
                }

            })


            ->editColumn('actions', function($section){
                return '<a href="' . route('admin.edit', ['id' => $section->id]) . '"><i class="fa-solid fa-pen-to-square px-2"></i> </a> <a href="' . route('admin.delete', ['id' => $section->id]) . '">   <i class="fa-regular fa-trash-can px-1"></i></a>';

            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admin-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('email')->title('Email'),
            // Column::make('mobile')->title('Mobile'),

            Column::make('permissions')->title('Roles'),
            // Column::make('created_at')->title('Created At'),
            // Column::make('updated_at')->title('Updated At'),
            Column::make('actions')->title('Action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
