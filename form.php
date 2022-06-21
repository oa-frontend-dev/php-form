<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    //забираем данные из формы по значению name
    $email = $_POST['email'];
    $password = $_POST['password'];

    //дать некоторые данные для подключения к БД
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_base = "users";
    $db_table = "login_info";
}
    try {
        //подключаемся к БД
        $db = new PDO ("mysql:host=$db_host; dbname=$db_base", $db_user, $db_password);
        //собрать данные для запроса
        $data = array('email' => $email, 'password' => $password);
        //подготовка sql запроса
        $query = $db -> prepare("INSERT INTO $db_table (email, password) values (:email, :password)");
        //выполнить запрос к БД вместе с новыми данными из формы
        $query->execute($data);
        $result = true;
    } catch (PDOException $e) {
        //Если есть ошибка соединения или выполнения запроса, то выводим ошибку на экран
        print "Ошибка: " . $e -> getMessage() . "</br>";
    } 

    if ($result) {
        echo "Успех. Информация занесена в базу данных";
    }

?>