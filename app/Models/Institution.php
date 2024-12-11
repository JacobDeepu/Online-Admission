<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'color_code',
        'logo_file_path',
        'header_file_path',
        'description',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'logo_url',
        'header_url',
    ];

    public function getLogoUrlAttribute()
    {
        $logoUrl = '';
        if ($this->attributes['logo_file_path']) {
            $logoUrl = url('storage/'.$this->attributes['logo_file_path']);
        }

        return $logoUrl;
    }

    public function getHeaderUrlAttribute()
    {
        $headerUrl = '';
        if ($this->attributes['header_file_path']) {
            $headerUrl = url('storage/'.$this->attributes['header_file_path']);
        }

        return $headerUrl;
    }

    /**
     * Get the sections for the institution.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(FormSection::class);
    }
}
