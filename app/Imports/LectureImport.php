<?php

namespace App\Imports;

use Ramsey\Uuid\Uuid;
use App\Models\Lecture;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class LectureImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {
            $data = explode(' - ', $value[7]);
            if (intval($data[0]) !== 0) {
                $nidnAlreadyExists = Lecture::where('nidn', $data[0])->exists();
                if (!$nidnAlreadyExists) {
                    Lecture::create([
                        'nidn' => $data[0],
                        'name' => strtoupper($data[1]) ?? '-',
                    ]);
                }
            }
        }
    }
}
