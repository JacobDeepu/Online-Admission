<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FormSubSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'form_section_id',
        'name',
        'icon',
        'order',
        'description',
    ];

    /**
     * Get the section that owns the subsection.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(FormSection::class);
    }

    /**
     * Get all of the subsections's fields.
     */
    public function fields(): MorphMany
    {
        return $this->morphMany(FormField::class, 'formable');
    }
}
