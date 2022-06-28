<?php
require 'libs/rb.php';
R::setup( 'mysql:host=localhost:3306;dbname=user', 'root', 'root' );
if ( !R::testConnection() )
{
 exit ('Нет соединения с базой данных');
}
session_start();
