<?php

namespace App\Imports;

use Ramsey\Uuid\Uuid;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $key => $value) {
            if ($value[1] && $value[2]) {
                if (intval($value[1]) !== 0) {
                    $nimAlreadyExist = Student::where('nim', $value[1])->exists();
                    if (!$nimAlreadyExist) {
                        $lecture1Data = explode(' - ', $value[7]);
                        $lecture2Data = explode(' - ', $collection[$key + 1][7]);
                        if (intval($lecture1Data[0]) !== 0 && intval($lecture2Data[0]) !== 0) {
                            $lecture1 = Lecture::where('nidn', $lecture1Data[0])->first();
                            $lecture2 = Lecture::where('nidn', $lecture2Data[0])->first();
                            if ($lecture1 && $lecture2) {
                                Student::create([
                                    'nim' => $value[1],
                                    'name' => strtoupper($value[2]),
                                    'lecture_1_id' => $lecture1->id,
                                    'lecture_2_id' => $lecture2->id,
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
