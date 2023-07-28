<?php 
namespace App\Validations;

use App\Models\AttributeDetailsModel; // Ganti YourModel dengan nama model yang sesuai

class CustomValidation
{
    public function isUniqueCombination(string $str, string $fields, array $data): bool
    {
        [$table, $columns] = explode('.', $fields);
        [$column1, $column2] = explode(',', $columns);

        $model = new AttributeDetailsModel(); // Ganti YourModel dengan nama model yang sesuai

        $existingRow = $model->where($column1, $data[$column1])->where($column2, $str)->first();

        return $existingRow === null;
    }
}


?>