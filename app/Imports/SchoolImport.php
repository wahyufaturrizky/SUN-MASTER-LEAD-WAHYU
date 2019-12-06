<?php

namespace App\Imports;

use App\School;
use Maatwebsite\Excel\Concerns\ToModel;

class SchoolImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new School([
            'kode_prop' => $row[0],
            'propinsi' => $row[1],
            'kode_kab_kota' => $row[2],
            'kabupaten_kota' => $row[3],
            'kode_kec' => $row[4],
            'kecamatan' => $row[5],
            'id' => $row[6],
            'npsn' => $row[7],
            'sekolah' => $row[8],
            'bentuk' => $row[9],
            'status' => $row[10],
            'alamat_jalan' => $row[11],
            'lintang' => $row[12],
            'bujur' => $row[13],
        ]);
    }
}
