# Warsztaty-2/Twitter

Warsztaty, które mają na celu napisanie w pełni funkcjonalnej aplikacji w stylu Twittera.

1. W katalogu Class znajdują się odpowiednie klasy, które zawierają funkcje do zapisu lub odczytu - użytkownika (User.php),
 nowego wpisu (Tweet.php), wiadomości do innego użytkownika (Message.php) lub komentarza (Comment.php).

2. W pliku login.php znajduje się formularz do zalogowania użytkownika. Dane wysyłane są na tę samą stronę motodą Post. Jeśli dane są poprawne
to Id użytkownika zapisywane jest do sesji i przechodzimy do strony głównej. W pliku znajduje się również link do strony newUser.php, gdzie znajdyje
się formularz do utworzenia nowego użytkownika. Dane wysyłane są metodą POST na stronę index.php.
(Nie działa poprawnie ponieważ zapisując nowego użytkownika nie zostaje on przkierowany na stronę główną tylko na stronę logowania. Po zalogowaniu
przechodzimy dopiero na stronę główną. I nie wiem dlaczego muszę kliknąć dwa razy żeby zadziałało?)

Jeśli wystąpi błąd przy logowaniu to pokaże się odpowiedni komunikat.
Jeśli nowy użytkownik chce użyć już istniejącego hasła, to również wystąpi odpowiedni komunikat.

3.W pliku index.php po sprawdzeniu sesji przechodzimy na stronę główną. W pliku posts.php znajduje się formularz do utworzenia nowego wpisu. Po odczytaniu, dane zostają zapisane 
do bazy danych. Z bazy pobierane są wszystkie wpisy wszystkich użytkowników, uporządkowane od najnowszego. W pliku znajduje się guzik do wylogowania, który polega na wyczyszczeniu
sesji. 
