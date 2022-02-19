<?php

// Реализовать на PHP пример Декоратора, 
// позволяющий отправлять уведомления несколькими различными способами.



interface MessageInterface
{
    public function makeMessage() : string;
}


class Message implements MessageInterface
{
    public function makeMessage() : string
    {
        return "Message with important information";
    }
}


class MessageDecorator implements MessageInterface
{
    protected $message;

    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    
    public function makeMessage() : string
    {
        return $this->message->makeMessage();
    }
}


class SMSMessageDecorator extends MessageDecorator
{   
    public function makeMessage() : string
    {
        return "SMS: " . parent::makeMessage();
    }
}


class EmailMessageDecorator extends MessageDecorator
{
    public function makeMessage() : string
    {
        return "Email: " . parent::makeMessage();
    }
}


class CNMessageDecorator extends MessageDecorator
{
    public function makeMessage() : string
    {
        return "Chrome Notification: " . parent::makeMessage();
    }
}


function sendMessage(MessageInterface $message)
{
    echo $message->makeMessage();
}



$simple = new Message();
echo "Client: I've got a simple component:<br>";
sendMessage($simple);
echo "<br><br>";



$decorator1 = new SMSMessageDecorator($simple);
$decorator2 = new EmailMessageDecorator($decorator1);
echo "Client: Now I've got a decorated component:<br>";
sendMessage($decorator2);
