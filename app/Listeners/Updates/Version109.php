<?php

namespace App\Listeners\Updates;

use App\Events\UpdateFinished;
use App\Models\Common\Company;
use Artisan;

class Version109 extends Listener
{
    const ALIAS = 'core';

    const VERSION = '1.0.9';

    /**
     * Handle the event.
     *
     * @param  $event
     */
    public function handle(UpdateFinished $event)
    {
        // Check if should listen
        if (!$this->check($event)) {
            return;
        }

        // Create new bill statuses
        $companies = Company::all();

        foreach ($companies as $company) {
            Artisan::call('module:install', ['alias' => 'offlinepayment', 'company_id' => $company->id]);
            Artisan::call('module:install', ['alias' => 'paypalstandard', 'company_id' => $company->id]);
        }
    }
}
