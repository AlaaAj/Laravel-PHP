<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Telegram;

class TelegramController extends Controller
{
    public function bot()
    {
        $updates = Telegram::getWebhookUpdates();
        $chat_id = $updates->Message->Chat->id;
        $order_id = $updates->Message->text;
        $order = Order::where('id' , $order_id )->first();
        if ($order === null) {
            Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => 'Wrong Order ID'
            ]);
        }else
        {
            $status = $order->status;
            $recipient = $order->user_name;
            $designerName='null';
            $printWorkerName='null';
            $designerId = $order->designer_id;
            $printWorkerId = $order->printWorker_id;
            $user = User::where('id' , $designerId )->first();
            if($user!=null)
                $designerName = $user->name;
            $user2 = User::where('id' ,$printWorkerId)->first();
            if($user2!=null)
                $printWorkerName = $user2->name;
            $message = 'Order Status: '.$status."\r\n".'Order Recipient: '.$recipient."\r\n"
                .'Order Designer: '.$designerName."\r\n".'Order PrintWorker: '.$printWorkerName;
            Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => $message
            ]);
        }
    }

    public function test($id)
    {
        $order = Order::where('id' , $id )->first();
        $status = $order->status;
        $recipient = $order->user_name;
        $designerName='null';
        $printWorkerName='null';
        $designerId = $order->designer_id;
        $printWorkerId = $order->printWorkerId;
        $user = User::where('id' , $designerId )->first();
        if($user!=null)
            $designerName = $user->name;
        $user = User::where('id' ,$printWorkerId)->first();
        if($user!=null)
            $printWorkerName = $user->name;
        $message = 'Order Status: '.$status."\r\n".'Order Recipient: '.$recipient."\r\n"
            .'Order Designer: '.$designerName."\r\n".'Order PrintWorker: '.$printWorkerName;
        return $message;
    }
}
