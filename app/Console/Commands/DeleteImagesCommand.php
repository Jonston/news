<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;

class DeleteImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //Команда для удаления временных изображений c необязательным --tmp флагом
    protected $signature = 'images:delete {--tmp}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete images';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Deleting tmp images...');

        $query = Image::query();

        if ($this->option('tmp')) {
            $query->where('tmp', true);
            $query->where('created_at', '<', now()->subHours());
        }

        $query->get()->each(function (Image $image) {
            $image->delete();
        });

        $this->info('Done.');
    }
}
