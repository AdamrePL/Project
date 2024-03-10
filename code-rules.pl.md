<!-- TODO edycja formatowania tekstu - zmniejszenie ilości niepotrzebnych headingów; Psuje to listę headingów które powinny zostać wykorzystane jako sekcje -->

# **Standardy kodowania dla tego projektu**
Jeżeli myślicie, że to co tutaj jest wypisane to przesada i że jest tego dużo. To dla przykładu sprawdzcie sobie [te standardy kodowania php-a](https://www.php-fig.org/psr/psr-2/ "Link do standardu kodowania PHP").
Nie wspominając o tym, że podany przykład jest przestarzały więc jest w nim jeszcze mniej rzeczy niż w nowszym. Poza tym to jest podstawowa wersja. Macie tutaj jeszcze [link do repo](https://github.com/php-fig/fig-standards/tree/c2eaf724e984671db5c352ec34883e72ab9d4e83/accepted) gdzie jest ich więcej.
A skoro już mowa o tym pliku, to polecam zobaczyć piąty podpunkt bo w sumie on też się zalicza w tym projekcie.

# Spis treści
1. [Język](#język-ogólny)
2. [Pliki](#pliki)
3. [Języki programowania](#języki-programowania)
   - [HTML](#html)
       + [Implementacja skryptów oraz stylizacji](#implementacja-skryptów-oraz-stylizacji)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku "Czytelność kodu HTML")
       + [Nazewnictwo](#nazewnictwo)
   - [CSS](#css)
       + [Nazewnictwo](#nazewnictwo-1)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-1 "Czytelność kodu CSS")
       + [Inne](#inne)
   - [PHP](#php)
       + [Nazewnictwo](#nazewnictwo-2)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-2 "Czytelność kodu PHP")
       + []
   - [JS](#js)
       + [Nazewnictwo](#nazewnictwo-3)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-3 "Czytelność kodu JS")
4. [Inne](#pozostałe)

# Język ogólny
### W kodzie wszelkie nazwenictwo czy to klas czy zmiennych powinno być w języku angielskim.
-----------------
# Pliki
### Nazewnictwo Plików 
**Pliki powinny być nazywane w języku angielskim.**
Jeżeli plik składa się z kilku słow, powinny one być rozdzielone znakiem '-'.
-----------------
# Języki programowania
<!-- TAK, WIEMY! ALE NAZWIJCIE TO INACZEJ ABY NAZWA BYLA OGOLNIE ROZPOZNAWANA -->

## HTML
### Implementacja skryptów oraz stylizacji
Jakikolwiek kod CSS oraz JavaScript powinien być w odzielnym pliku. W kodzie HTML czy PHP nie powinno się znajdować żadnych wewnętrznych styli ani skryptów;
##### Przykład
```HTML
<head>
    <style></style>
</head>

<script> DoSomething() </script>
```

### Utrzymywanie kodu w porządku
Kod powinien mieć 4 spacje wcięcia jeżeli element jest umieszczony w innym elemencie.
##### Przykład
```HTML
<div class="wrapper">
    <h1>lista</h1>
    <ul>
        <li>
            <p>lorem ipsum</p>
            <span>some very long desc</span>
            <a>attached link</a>
        </li>
        <li></li>
    </ul>
</div>
```

Elementy których nie trzeba zamykać, ale można np. `<input>`, mają być zamknięte ukośnikiem na końcu: `<input />`.

Skrypty powinny znajdować się w elemencie `<head>` i mieć atrybuty `defer` lub `async`, zależnie od tego jak mają się ładować.

### Nazewnictwo
Wszystkie elementy powinny być pisane małymi literami; wyjątkami są własne niestandardowo zdefiniowane elementy, ale wątpie, żeby jakiekolwiek miałyby być tutaj dodane.

Nazwy jakichkolwiek elementów formularza, (które wymagają/potrzebują atrybutu nazwy) jeżeli składają się z przynajmniej 2 słow to muszą być rozdzielone za pomocą znaku "-".

Wyrazy w nazwach klas powinny być rozdzielane znakiem '-' np. "centered-item".

Wszelkiego nazwy klas dla pojemników powinny mieć w nazwie "-wrapper", "\*nazwa\*-wrapper" zamiast "\*nazwa\*-container", np. "content-wrapper".

## CSS
### Nazewnictwo
Nazwy zmiennych nie mogą zaczynać się cyfrą, a z nazwy zmiennej ma być wiadomo do czego jest ta zmienna.

Co do stylu pisania zmiennych w css-ie, możecie je pisać jakkolwiek chcecie, dopóki zmienna nie jest pisana na przemian z dużych i małych liter.

Selektory elementow (np. klasy), właściwości oraz ich wartości powinny być pisane z małymi literami.

### Utrzymywanie kodu w porządku
Po podaniu Selektora elementu pomiędzy selektorem, a klamrą powinnien być odstęp jednej spacji.

Jeżeli

Klamry zawsze powinny mieć wcięcie do następnej lini, a w jednej lini powinna się znajdować maksymalnie jedna właściwość.
#### Przykład:
```CSS
.content-wrapper,
.details-wrapper {
    display: flex;
    gap: 2rem;
}
```

### Inne
###### Jako, że na stronie chcemy utrzymać resoponsywność mimo braku wsparcia dla urządzeń mobilnych na początek, zaleca się używania metod Flexbox czy Grid do ustawiania elementów na stronie oraz omijania inline-block czy pozycjonowania absolutnego/stałego.

## PHP 
### Nazewnictwo
Każde zapytanie SQL wprowadzone w PHP-ie przed dodaniem do jakiejkolwiek funkcji MySQL powinno pozostać przypisane do zmiennej `$sql`.

> [!TIP]
> Polecam używać zmiennej $query dla mysqli_query oraz $stmt dla mysqli_stmt_prepare

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
**Wyjątkiem jest oczywiście gdy element ma być kilkukrotnie tworzony przez pętle itd.**


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

> [!TIP]
> Zmienne przeznaczone dla ajax-a zalecam nazywać się "xhr" (+ numer zmiennej, albo slowo znaczące jeżeli jest więcej niz 1 w kodzie).

### Utrzymywanie kodu w porządku

-----------------

Pozostałe
------
###### Wszędzie w każdych wcięciach powinny zostać użyte 4 spacje, nie tabulatory.

[^1]: [camelCase](https://pl.wikipedia.org/wiki/CamelCase "Link do wikipedii")
