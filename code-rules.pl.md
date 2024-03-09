<!-- TODO edycja formatowania tekstu - zmniejszenie ilości niepotrzebnych headingów; Psuje to listę headingów które powinny zostać wykorzystane jako sekcje -->

# **Standardy kodowania dla tego projektu**
Jeżeli myślicie, że to co tutaj jest wypisane to przesada i że jest tego dużo. To dla przykładu sprawdzcie sobie [te standardy kodowania php-a](https://www.php-fig.org/psr/psr-2/ "Link do standardu kodowania PHP").
Nie wspominając o tym, że podany przykład jest przestarzały więc tam tego jest jeszcze mniej niż w nowszym.
A skoro już mowa o tym pliku, to polecam zobaczyć piąty podpunkt bo w sumie on też i tutaj w tym projekcie się zalicza.

# Spis treści
1. [Język](#język-ogólny)
2. [Pliki](#pliki)
3. [Języki programowania](#języki-programowania)
   - [HTML](#html)
       + [Implementacja skryptów oraz stylizacji](#implementacja-skryptów-oraz-stylizacji1)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku)
   - [CSS](#css)
       + [Nazewnictwo](#nazewnictwo)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-1)
       + []
   - [PHP](#php)
       + [Nazewnictwo](#nazewnictwo-1)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-2)
       + []
   - [JS](#js)
       + [Nazewnictwo](#nazewnictwo-2)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku)

4. [Inne](#pozostałe)

# Język ogólny
### W kodzie wszelkie nazwenictwo czy to klas czy zmiennych powinno być w języku angielskim.
-----------------
# Pliki
### Nazewnictwo Plików 
**Pliki powinny być nazywane w języku angielskim.**
Jeżeli plik składa się z kilku słow, powinny one być rozdzielone znakiem '-'.

# Języki programowania
<!-- TAK, WIEMY! ALE NAZWIJCIE TO INACZEJ ABY NAZWA BYLA OGOLNIE ROZPOZNAWANA -->

## HTML
### Implementacja skryptów oraz stylizacji[^1]
Jakikolwiek kod CSS oraz JavaScript powinien być w odzielnym pliku. W kodzie HTML czy PHP nie powinno się znajdować żadnych wewnętrznych styli ani skryptów;
##### Przykład
```HTML
<head>
    <style></style>
</head>

<script> DoSomething() </script>
```
Elementy których nie trzeba zamykać, ale można np. <input>, mają być zamknięte ukośnikiem na końcu `<input />`

Nazwy jakichkolwiek elementów formularza, (które wymagają/potrzebują atrybutu nazwy) jeżeli składają się z przynajmniej 2 słow to muszą być rozdzielone za pomocą znaku "-";


## PHP 
### Nazewnictwo
Każde zapytanie SQL wprowadzone w PHP-ie przed dodaniem do jakiejkolwiek funkcji MySQL powinno pozostać przypisane do zmiennej `$sql`.

Zmienne przeznaczone dla "prepared statements" powinny nazywać się `$stmt`.

Nazwa funkcji oraz zmiennej powinna być rozdzielana znakiem '_' jeżeli składa się z dwóch słów lub więcej.
### Utrzymywanie kodu w porządku
**Jeżeli można to elementy dawać poza kodem PHP i wartości dodawać kodem wewnątrz elementu.**
#### Przykład
```PHP
<div id="<?php echo $result["entryid"]; ?>"><?php echo $_$GET["page"]; ?></div>
```
Zamiast:
```PHP
echo '<div id="' . $result["entryid"] . '">' . $_$GET["page"] . '</div>';
```
Wyjątkiem jest oczywiście gdy element ma być kilkukrotnie tworzony przez pętle itd.

## CSS
### Nazewnictwo
Wyrazy w nazwach klas powinny być rozdzielane znakiem '-' np. "centered-item".

Wszelkiego nazwy klas dla pojemników powinny być mieć w nazwie "\*nazwa\*-wrapper" zamiast "\*nazwa\*-container", np. "content-wrapper".

Właściwości oraz ich wartości powinny być pisane z małymi literami.

### Utrzymywanie kodu w porządku
Po podaniu Selector-a elementu pomiędzy selektor-em, a klamrą powinnien być odstęp jednej spacji.

Klamry zawsze powinny mieć wcięcie do następnej lini, a w jednej lini powinna się znajdować maksymalnie jedna właściwość.
#### Przykład:
```CSS
.content-wrapper,
.details-wrapper {
    display: flex;
    gap: 2rem;
}
```
## JavaScript
### Nazewnictwo
Nazwy funkcji powinny zaczynać się od małej litery.. o ile ta funckja będzie miała jakąś nazwe.

Jeżeli nazwa funkcji zawiera 2 lub wiecej słow to nie są one rozdzielane, ale każde nowe słowo zaczynające wewnątrz nazwy powinno rozpoczynać się wielką literą.[^2]
#### Przykład
```Js
function makeDiv() {
    let mydiv = document.createElement("div");
    mydiv.className = "centered";
    return mydiv;
}

const newtab = makeDiv()
```

Zmienne przeznaczone dla ajax-a powinny nazywać się "xhr" (+ numer zmiennej jeżeli jest więcej niz 1).

### Utrzymanie kodu w porządku
-----------------

Pozostałe
------
##### Wszystkie: 
###### Wszędzie w każdych wcięciach powinny zostać użyte 4 spacje, nie tabulatory.

##### CSS:
###### Jako, że na stronie chcemy utrzymać resoponsywność mimo braku wsparcia dla urządzeń mobilnych na początek, zaleca się używania metod Flexbox czy Grid do ustawiania elementów na stronie oraz omijania inline-block czy pozycjonowania absolutnego/stałego.


[^1]: Dotyczy również PHP-a
[^2]: [camelCase](https://pl.wikipedia.org/wiki/CamelCase "Link do wikipedii")
