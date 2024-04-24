<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'userId' => Str::orderedUuid(),
            'name' => $row[0],
            'email' => strtolower($row[1]),
            'password' => Hash::make('Calibration24!'),
            'role_id' => $row[2]
        ]);

        return $user;
    }
}
