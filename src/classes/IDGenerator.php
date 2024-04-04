<?php

// @derfiedev , 
// tak sobie patrzylem na ten kod, i male poprawki dalem tu,
// ponieważ chcemy aby id uzytkownika zawieralo cyfry, duze i male litery, ale rowniez zeby jego nazwa uzytkownika byla tylko z malych liter
// poza tym to poprawilem wydajnosc generowania tego uid, (dzieki temu ze dodales cos takiego jak array_merge, a nie mialem o tym pojecia ze istnieje)
// już bardziej zooptymalizowany być nie może.

// Anyway, uhh. teraz tez i wiadomość do wszystkich @chopa113 , @Anaxar1 , 
// skoro zmieniamy projekt calkowicie na OOP, (wow że wam sie jednak chce... no ale dobra)
// zamiast tworzyc następny folder, z klasami ('classes'), to zamiast tego, to z czego zamieniliscie na OOP, usuncie a w tym samym pliku dodajcie wersje OOP
// chodzi o folder controller.
// a jeżeli chodzi o sam folder 'classes', to niech on bedzie na poziomie 'src', a nie w nim, tak jak 'controllers'

// jezeli chodzi o pliki, to pls pls pls, zeby wszytko bylo z malych liter odzielane znakiem '-' (lub nie odzielane), ale zeby byl jeden styl ich nazewnictwa
// czyli np. uzywamy tylko xxxx-xxx.php, albo xxxx.xxxxxx.php, albo, xxxxxxx.php

// a co do sciezek, zrobilem taki fajny trik, jezeli wpiszecie $_SERVER["BASE"], to przeniesie was do folderu głownego, 
// a sciezka bedzie wygladac nastepujaco: 
// '/'
// gdzie foldery sprzed indexa sa teorytycznie ignorowane
// czyli moze byc np. 'C:/some/folder/idk/www/github/Project/'
// gdzie $_SERVER["DOCUMENT_ROOT"] bylby ustawiony na '/www/', to zamiast wrocic na '/www/github/Project/' to wrocilo by na '/www/'
// ale $_SERVER["BASE"] i tak i tak, pozostanie na '/www/github/Project/', nie wazne gdzie jest ustawiony document_root
// jest to dobre np w przypadku uzycia headerow, lub zamiast wpisywania ../../../ zeby gdzies wrocic i ponownie przejsc do nastepnego folderu,
// a jak np chcielibyscie cos includowac, to:
// zamiast z folderu .. eee.. o! 'classes', aby wziasc coz z 'controllers', to zamiast wpisywania ../../controllers/account-controller.php
// wystarczy ze wpiszecie $_SERVER["BASE"] . "controllers/account-controller.php"

class IDGenerator {
    private $length;
    private $name;
    private string $split_character = '#';
    
    public function __construct(int $length = 3, string $name)
    {
        $this->length = $length;
        $this->name = strtolower($name);
    }
    
    public function get_length(): int
    {
        return $this->length;
    }
    
    public function set_length(int $length): void
    {
        $this->length = $length;
    }

    public function get_name(): string
    {
        return $this->name;
    }
    
    public function set_name(string $name): void
    {
        $this->name = $name;
    }


    public function generate_ID(): string
    {
        $chars = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        $result = array_rand($chars, $this->length);

        return $this->name . $this->split_character . $result;
    }
}
