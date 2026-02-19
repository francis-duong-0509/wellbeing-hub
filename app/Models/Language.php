<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nnjeim\World\Models\Language as LanguageModel;

class Language extends LanguageModel
{
    use HasFactory;

    const LANGUAGE_DEFAULT = 'vi';
}
