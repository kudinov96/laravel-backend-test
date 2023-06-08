<?php

namespace App\Jobs;

use App\Actions\CreateRow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ParseExcelRowsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $rows;

    /**
     * Create a new job instance.
     */
    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->rows as $key => $row) {
            if ($row[0] === "id") continue;

            try {
                (new CreateRow())->handle([
                    "id"   => $row[0],
                    "name" => $row[1],
                    "date" => $row[2],
                ]);
            } catch (\Exception $exception) {
                Log::debug(print_r($key, true));
                Log::debug(print_r($row, true));
            }
        }
    }
}
