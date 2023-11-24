<?php

namespace App\Console\Commands;

use App\Api\Facades\Siigo;
use Illuminate\Console\Command;
use App\Models\{Log as ModelLog, SiigoUpdateStock};

class DecrementStockInSiigoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:decrement_stock_in_siigo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el stock en SIIGO cuando un pedido esta en estado aprobado.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        $record= SiigoUpdateStock::where('send_siigo', false)->first();
        $response= Siigo::sendAccountantDocument($record->code, $record->quantity, 'Credit', 'Debit');
        $record->update(['send_siigo' =>  true, 'response' => json_encode($response)]);
    }
}