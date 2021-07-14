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
    public function handle()
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host = "700rdns1.websouls.net";
        $mail->SMTPAuth = true;
        $mail->Username = 'info@aimscal.com';
        $mail->Password = '4Ghulamhussain@472';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('info@aimscal.com', 'AIMS CAL LAB');
        // Add a recipient
        $mail->addAddress('emazeem07@gmail.com', 'Muhammad Azeem');
        //$mail->addAttachment(public_path('img/quotes/'.$attachment),$attachment);
        $mail->isHTML(true);
        $mail->Subject = 'Quote Reminder';
        $mail->Body = 'Dear Sir, AIMS QTN/0000001 have been forwarded to you for the calibration of mentioned 
                                    instruments. Kindly intimate quote approval status accordingly. <br> Regards : Imtiaz Ahmed <br> Cell # 03016236150';
        if ($mail->send()) {

        }
/*
        $quotes=Quotes::all()->where('status',2);
        foreach ($quotes as $quote){
            $data = [
                0 =>1,
                1 =>2,
                2 =>3,
                3 =>3,
                4 => 0
            ];
            $created=strtotime($quote->sendtocustomer_date);
            $send= date('Y-m-d',$created+($data[$quote->reminder]*86400));
            if ($data[$quote->reminder]==0) {
                //change status of quote from 2 to dormant customer status;
            }else{
                if ($send == date('Y-m-d')) {
                    $mail = new PHPMailer(true);
                    $mail->SMTPDebug = 4;
                    $mail->isSMTP();
                    $mail->Host = "700rdns1.websouls.net";
                    $mail->SMTPAuth = true;
                    $mail->Username = 'info@aimscal.com';
                    $mail->Password = '4Ghulamhussain@472';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('info@aimscal.com', 'AIMS CAL LAB');
                    // Add a recipient
                    $mail->addAddress('emazeem07@gmail.com', 'Muhammad Azeem');
                    //$mail->addAttachment(public_path('img/quotes/'.$attachment),$attachment);
                    $mail->isHTML(true);
                    $mail->Subject = 'Quote Reminder';
                    $mail->Body = 'Dear Sir, AIMS '.$quote->cid.' have been forwarded to you for the calibration of mentioned
                                    instruments. Kindly intimate quote approval status accordingly. <br> Regards : Imtiaz Ahmed <br> Cell # 03016236150';
                    if ($mail->send()) {
                        $quote->reminder = $quote->reminder + 1;
                        $quote->save();
                    }
                }
            }
        }
        return 0;*/
    }
}
// 7 15 30 60_days