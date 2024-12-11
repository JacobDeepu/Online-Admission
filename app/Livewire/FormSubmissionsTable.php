<?php

namespace App\Livewire;

use App\Models\FormSubmission;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class FormSubmissionsTable extends DataTableComponent
{
    protected $model = FormSubmission::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
                ->sortable(),
            Column::make('Date', 'created_at')
                ->sortable(),
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
}
