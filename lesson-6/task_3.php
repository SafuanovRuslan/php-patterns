<?php

// Команда: вы — разработчик продукта Macrosoft World. Это текстовый редактор с возможностями 
// копирования, вырезания и вставки текста (пока только это). Необходимо реализовать механизм 
// по логированию этих операций и возможностью отмены и возврата действий. Т. е., в ходе работы 
// программы вы открываете текстовый файл .txt, выделяете участок кода (два значения: начало и конец) 
// и выбираете, что с этим кодом делать.

interface Command
{
    public function execute($file) : void;
}


class Copy implements Command
{
    public function __construct(int $start, int $length)
    {
        $this->start = $start;
        $this->length = $length;
    }

    public function execute($file) : void
    {
        $curentContent = $file->states[count($file->states) - 1];
        $file->buffer = mb_substr($curentContent, $this->start, $this->length);
    }
}


class Past implements Command
{
    public function __construct(int $position)
    {
        $this->position = $position;
    }

    public function execute($file) : void
    {
        $curentContent = $file->states[count($file->states) - 1];
        $newContent = substr_replace($curentContent, $file->buffer, $this->position, 0);
        $file->states[] = $newContent;
    }
}


class Cut implements Command
{
    public function __construct(int $start, int $length)
    {
        $this->start = $start;
        $this->length = $length;
    }

    public function execute($file) : void
    {
        $curentContent = $file->states[count($file->states) - 1];
        $substr = mb_substr($curentContent, $this->start, $this->length);
        $file->buffer = $substr;
        $newContent = substr_replace($curentContent, '', $this->start, $this->length);
        $file->states[] = $newContent;
    }
}


class Cancell implements Command
{
    public function execute($file) : void
    {
        array_pop($file->states);
        echo $file->states[count($file->states) - 1];
    }
}


class Save implements Command
{
    public function execute($file) : void
    {
        file_put_contents($file->filePath, $file->states[count($file->states) - 1]);
    }
}


class MSWorld {
    /**
     * @var String Путь к целевому файлу
     */
    public $filePath;
    public $fileContent;
    public $states = [];
    public $buffer = '';

    public function __construct(string $filePath) 
    {
        $this->filePath = $filePath;
        $this->fileContent = file_get_contents($filePath);
        $this->states[] = $this->fileContent;
    }

    public function execute(Command $command) : void
    {
        $command->execute($this);
    }
}


$text = new MSWorld('task_3.txt');
$text->execute(new Copy(22, 2));  // Копируем смайлик
$text->execute(new Past(24));     // Вставляем смайлик
$text->execute(new Past(26));     // Вставляем смайлик
$text->execute(new Past(28));     // Вставляем смайлик, теперь их 4
$text->execute(new Cut(26, 2));   // Один вырезали, снова 3
$text->execute(new Cancell);      // Отменили действие, опять 4
$text->execute(new Save);         // Сохраняем изменения в файле