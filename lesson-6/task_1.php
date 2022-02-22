<?php

// Наблюдатель: есть сайт HandHunter.gb. На нем работники могут подыскать себе вакансию РНР-программиста. 
// Необходимо реализовать классы искателей с их именем, почтой и стажем работы. Также реализовать возможность
// в любой момент встать на биржу вакансий (подписаться на уведомления), либо же, напротив, выйти из гонки 
// за местом. Таким образом, как только появится новая вакансия программиста, все жаждущие автоматически 
// получат уведомления на почту (можно реализовать условно).

class Subject implements SplSubject
{
    /**
     * @var SplObjectStorage Список подписчиков.
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    /**
     * Методы управления подпиской.
     */
    public function attach(SplObserver $observer) : void
    {
        echo "Subject: Attached an observer.<br>";
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer) : void
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer.<br>";
    }

    /**
     * Запуск обновления в каждом подписчике.
     */
    public function notify() : void
    {
        echo "Subject: Notifying observers...<br>";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}



class Worker implements SplObserver
{
    private $name;
    private $email;
    private $experience;

    public function __construct($name, $email, $experience) 
    {
        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }
    public function update(SplSubject $subject) : void
    {
        echo "$this->name, вам доступна новая вакансия<br>";
    }
}



$worker1 = new Worker('Safuanov Ruslan', 'safuanov.ru@yandex.ru', 0);
$worker2 = new Worker('Pavel Durov', 'durov@vk.ru', 999);
$worker3 = new Worker('Tema Lebedev', 'al@gmail.com', 12);

$subject = new Subject();

$subject->attach($worker1);
$subject->attach($worker3);

$subject->notify();

$subject->detach($worker3);

$subject->notify();