<?php

namespace App\Livewire;

use App\Exports\FormSubmissionsExport;
use App\Models\FormSubmission;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FormSubmissionsTable extends DataTableComponent
{
    protected $model = FormSubmission::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setBulkActions([
                'export' => 'Export',
            ])
            ->setSelectAllEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Institution', 'institution.name')
                ->sortable(),
            Column::make('Name', 'submission_data->name')
                ->sortable(),
            Column::make('Status', 'status')
                ->format(
                    function ($value) {
                        $class = 'flex justify-center items-center py-2 px-3 rounded-full ';
                        if ($value != 'pending') {
                            return '<span class="'.$class.'bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">'.ucfirst($value).'</span>';
                        } else {
                            return '<span class="'.$class.'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">'.ucfirst($value).'</span>';
                        }
                    }
                )
                ->html(),
            Column::make('Date', 'created_at')
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn ($row) => 'View')
                ->location(fn ($row) => route('form-submissions.show', $row))
                ->attributes(function ($row) {
                    return [
                        'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 bg-indigo-950 text-white hover:bg-indigo-950 focus:ring-indigo-300',
                        'wire:navigate' => '',
                    ];
                }),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Institution', 'institution')
                ->options(
                    Institution::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($tag) => $tag->name)
                        ->toArray()
                )
                ->setFirstOption('All')
                ->filter(function (Builder $builder, array $values) {
                    $builder->whereIn('institution_id', $values);
                }),
            DateFilter::make('Date', 'created_at')
                ->config([
                    'max' => now()->format('Y-m-d'),
                    'pillFormat' => 'd M Y',
                    'placeholder' => 'Enter Date',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder
                        ->whereDate('form_submissions.created_at', $value);
                }),
        ];
    }

    public function export(): BinaryFileResponse
    {
        $data = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new FormSubmissionsExport($data), 'applications.xlsx');
    }
}
