<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Yajra\DataTables\Html\Column;

class AdvancedSearchDataTable extends Component
{
    private mixed $tableBuilder;

    /**
     * Create a new component instance.
     */
    public function __construct(private readonly string $model)
    {
        $this->tableBuilder = app('datatables.html');
        $this->tableBuilder
            ->setTableId(class_basename($this->model) . '_table')
            ->addTableClass('w-100')
            ->columns(
                collect($this->model::TABLE_COLUMNS)
                    ->map(fn($column) => Column::make($column, __("validation.attributes.$column")))
                    ->toArray()
            );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advanced-search-data-table', ['dataTable' => $this->tableBuilder, 'model' => $this->model]);
    }
}
