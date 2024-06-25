<!DOCTYPE html>
<html>
<head>
    <title>Formularz dodawania użytkownika</title>
</head>
<body>
    <h1>Dodaj nowego użytkownika</h1>
    <form action="/?action=addUser" method="post">
        <label for="imie">Imię:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>

        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="haslo">Hasło:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Dodaj użytkownika">
    </form>
</body>
</html>
