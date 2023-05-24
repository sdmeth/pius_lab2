<?php

namespace App\Console\Commands;

use App\Models\Banner;
use Illuminate\Console\Command;

    class DeactivateBanner extends Command
    {
        protected $signature = 'banner:deactivate {id}';

        protected $description = 'Deactivate banner by {id}';

        public function handle() : void
        {
            $id = $this->argument('id');
            $banner = Banner::find($id);

            if (!$banner) {
                $this->error("ERROR: banner_{$id} wasn't found");
            } elseif (!$banner->is_active) {
                $this->error("ERROR: banner_{$id} is already deactivated");
            } else {
                $banner->is_active = false;
                $banner->active_until = now();
                $banner->save();
                $this->info("banner_{$id} has been deactivated");
            }
        }
    }
    