<?php

session_start();

if (isset($_SESSION['foo'])) {
    echo $_SESSION['foo']."\n";
    echo "it was set";
} else {
    $_SESSION['foo'] = 'bar';
    echo "Just set it";
}