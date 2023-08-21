<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;

class ValidParentCategory implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the parent_id exists in the Category model
        if ($value == 0) {
            return true;
        } else {
            return Category::where('id', $value)->exists();
        }
    }

    public function message()
    {
        return 'The selected parent category is invalid.';
    }
}