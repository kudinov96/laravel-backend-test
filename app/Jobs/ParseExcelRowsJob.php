<?php

namespace App\Jobs;

use App\Actions\CreateRow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseExcelRowsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array  $rows;
    private string $uniqueKey;

    /**
     * Create a new job instance.
     */
    public function __construct(array $rows, string $uniqueKey)
    {
        $this->rows      = $rows;
        $this->uniqueKey = $uniqueKey;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->rows as $row) {
            if (!isset($row[0]) || $row[0] === "id") continue;

            (new CreateRow())->handle([
                "id"   => $row[0],
                "name" => $row[1] ?? null,
                "date" => $row[2] ?? null,
            ]);
        }
    }
}
