<?php

namespace App\Exports\Back\Settings;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{
    private int $group;

    /**
     * UsersExport constructor.
     * @param int $group
     */
    public function __construct(int $group)
    {
        $this->group = $group;
    }

    public function headings(): array
    {
        return [
            '#',
            'name',
            'email',
        ];
    }


    public function query()
    {
        switch ($this->group) {
            case 0:
                return User::query()->where('group', 0);
                break;

            case 1:
                return User::query()->where('group', 1);
                break;

            default:
                return User::all();
        }
    }
}
