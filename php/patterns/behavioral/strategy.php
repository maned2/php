<?php
/*
Стратегия (Strategy) - поведенческий шаблон проектирования, предназначенный для определения семейства алгоритмов,
инкапсуляции каждого из них и обеспечения их взаимозаменяемости.
Это позволяет выбирать алгоритм путём определения соответствующего класса.
Шаблон Strategy позволяет менять выбранный алгоритм независимо от объектов-клиентов, которые его используют.
*/


interface NamingStrategy
{
    function createName($filename);
}

class ZipFileNamingStrategy implements NamingStrategy
{
    function createName($filename)
    {
        return "http://downloads.foo.bar/{$filename}.zip";
    }
}

class TarGzFileNamingStrategy implements NamingStrategy
{
    function createName($filename)
    {
        return "http://downloads.foo.bar/{$filename}.tar.gz";
    }
}

class Context
{
    private $namingStrategy;

    function __construct(NamingStrategy $strategy)
    {
        $this->namingStrategy = $strategy;
    }

    function execute()
    {
        $url[] = $this->namingStrategy->createName("Calc101");
        $url[] = $this->namingStrategy->createName("Stat2000");

        return $url;
    }
}

if (strstr($_SERVER["HTTP_USER_AGENT"], "Win"))
    $context = new Context(new ZipFileNamingStrategy());
else
    $context = new Context(new TarGzFileNamingStrategy());

$context->execute();
