<?php

namespace Database\Seeds;

use App\Models\Model;
use App\Models\Banking\Account;
use Setting;
use Illuminate\Database\Seeder;

class Accounts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->create();

        Model::reguard();
    }

    private function create()
    {
        $company_id = $this->command->argument('company');

        $rows = [
            [
                'company_id' => $company_id,
                'name' => trans('demo.accounts_cash'),
                'number' => '1',
                'currency_code' => 'USD',
                'bank_name' => trans('demo.accounts_cash'),
                'enabled' => '1',
            ],
        ];

        foreach ($rows as $row) {
            $account = Account::create($row);

            Setting::set('general.default_account', $account->id);
        }
    }
}
