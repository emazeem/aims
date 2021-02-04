<?php

namespace App\Console\Commands;

use App\Models\Department;
use App\Models\Quotes;
use Illuminate\Console\Command;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class QuoteReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:quote_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $quotes=Quotes::all()->where('status',2);
        foreach ($quotes as $quote){
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = "sg3plcpnl0013.prod.sin3.secureserver.net";
            $mail->SMTPAuth = true;
            $mail->Username = 'info@aimslims.com';
            $mail->Password = 'aimslimsaimslims';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('info@aimslims.com', 'GO DADDY');
            $mail->addAddress('emazeem07@gmail.com', 'Em_Azeem');
            $mail->isHTML(true);
            $mail->Subject = 'Quote Reminder';
            $mail->Body    = 'AIMS is reminding you to response back on previous quote';
            $mail->send();

        }
        return'quote';
    }
}
// 7 15 30 60_days