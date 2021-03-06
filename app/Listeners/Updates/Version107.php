<?php

namespace App\Listeners\Updates;

use App\Events\UpdateFinished;
use DB;

class Version107 extends Listener
{
    const ALIAS = 'core';

    const VERSION = '1.0.7';

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

        $table = env('DB_PREFIX').'taxes';

        DB::statement("ALTER TABLE `$table` MODIFY `rate` DOUBLE(15,4) NOT NULL");
    }
}
