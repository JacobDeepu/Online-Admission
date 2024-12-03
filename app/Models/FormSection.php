<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FormSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'institution_id',
        'name',
        'icon',
        'description',
    ];

    /**
     * Get the subSections for the section.
     */
    public function subSections(): HasMany
    {
        return $this->hasMany(FormSubSection::class);
    }

    /**
     * Get all of the sections's fields.
     */
    public function fields(): MorphMany
    {
        return $this->morphMany(FormField::class, 'formable');
    }
}
