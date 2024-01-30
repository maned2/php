<?php
/*
Наблюдатель (англ. Observer) — поведенческий шаблон проектирования. Также известен как «подчинённые» (англ. Dependents).
Реализует у класса механизм, который позволяет объекту этого класса получать оповещения об изменении состояния других
объектов и тем самым наблюдать за ними.

Классы, на события которых другие классы подписываются, называются субъектами (Subjects),
а подписывающиеся классы называются наблюдателями (англ. Observers).
*/


interface Observer
{
    function notify($obj);
}

class ExchangeRate
{
    static private $instance = NULL;
    private $observers = array();
    private $exchange_rate;

    private function __construct()
    {}

    private function __clone()
    {}

    static public function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new ExchangeRate();
        }
        return self::$instance;
    }

    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate($new_rate)
    {
        $this->exchange_rate = $new_rate;
        $this->notifyObservers();
    }

    public function registerObserver(Observer $obj)
    {
        $this->observers[] = $obj;
    }

    function notifyObservers()
    {
        foreach($this->observers as $obj)
        {
            $obj->notify($this);
        }
    }
}

class ProductItem implements Observer
{

    public function __construct()
    {
        ExchangeRate::getInstance()->registerObserver($this);
    }

    public function notify($obj)
    {
        if($obj instanceof ExchangeRate)
        {
            // Update exchange rate data
            print "Received update!\n";
        }
    }
}

$product1 = new ProductItem();
$product2 = new ProductItem();

ExchangeRate::getInstance()->setExchangeRate(4.5);