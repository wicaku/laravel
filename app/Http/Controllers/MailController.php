<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        $objVerified = new \stdClass();
        $objVerified->demo_one = 'Demo One Value';
        $objVerified->demo_two = 'Demo Two Value';
        $objVerified->sender = 'Egovbench ADDI ITS';
        $objVerified->receiver = 'ReceiverUserName';

        Mail::to("nodyriskypratomo@gmail.com")->send(new DemoEmail($objDemo));
    }
}
