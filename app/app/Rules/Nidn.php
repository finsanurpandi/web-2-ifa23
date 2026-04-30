<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Department;

class Nidn implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $kodeProdi = substr($value,0,5);
        $department = Department::where('code', $kodeProdi)->first();

        if(!$department) {
            $fail('5 karakter awal harus merupakan kode prodi');
        }
    }
}
