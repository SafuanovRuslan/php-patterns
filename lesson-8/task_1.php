<?php

// Написать аналог «Проводника» в Windows для директорий на сервере при помощи итераторов.

class MyDirectory {

    public function showDirContent($dir) {
        $directory = new DirectoryIterator($dir);

        echo '<ul>';
        foreach ($directory as $item) {

            if ($item->valid() && $item != '.' && $item != '..') {
                echo '<li>' . $item;

                if ($item->isDir()) {
                    $this->showDirContent($dir . '/' . $item);
                }

                echo '</li>';
            }

        }
        echo '</ul>';
    }

}

$dir = new MyDirectory();
$dir->showDirContent('.');