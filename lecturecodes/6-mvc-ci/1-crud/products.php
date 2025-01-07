<br />
<b>Warning</b>:  include_once(database.php): failed to open stream: No such file or directory in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  include_once(): Failed opening 'database.php' for inclusion (include_path='.;C:\xampp\php\PEAR') in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>3</b><br />
<br />
<b>Notice</b>:  Undefined variable: servername in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>5</b><br />
<br />
<b>Notice</b>:  Undefined variable: dbname in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>5</b><br />
<br />
<b>Notice</b>:  Undefined variable: username in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>5</b><br />
<br />
<b>Notice</b>:  Undefined variable: password in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>5</b><br />
<br />
<b>Fatal error</b>:  Uncaught exception 'PDOException' with message 'SQLSTATE[HY000] [1045] Access denied for user ''@'localhost' (using password: NO)' in C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php:5
Stack trace:
#0 C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php(5): PDO-&gt;__construct('mysql:host=;dbn...', NULL, NULL)
#1 C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products.php(2): include_once('C:\\xampp\\htdocs...')
#2 {main}
  thrown in <b>C:\xampp\htdocs\lecturecodes\6-mvc-ci\1-crud\products_crud.php</b> on line <b>5</b><br />
