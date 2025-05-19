<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Ramsey\Uuid\Uuid;

class StudentImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {
            if ($value[1] && $value[2]) {
                if (intval($value[1]) !== 0) {
                    $nimAlreadyExist = Student::where('nim', $value[1])->exists();
                    if (!$nimAlreadyExist) {
                        Student::create([
                            'nim' => $value[1] ?? Uuid::uuid4()->toString(),
                            'name' => strtoupper($value[2]) ?? '-',
                        ]);
                    }
                }
            }
        }
    }
}
