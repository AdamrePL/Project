# Spis treści
1. [Język](#język-ogólny)
2. [Języki programowania](#języki-programowania-)
   - [HTML](#html)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku)
       + []
   - [CSS](#css)
       + [Nazewnictwo](#nazewnictwo)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-1)
       + []
   - [PHP](#php)
       + [Nazewnictwo](#nazewnictwo-1)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku-2)
       + []
   - [JS](#js)
       + [Utrzymanie kodu w porządku](#utrzymywanie-kodu-w-porządku)

3. [Inne](#pozostałe)

# Język ogólny
### W kodzie wszelkie nazwenictwo czy to klas czy zmiennych powinno być w języku angielskim.
-----------------

# Języki programowania <!-- TAK, WIEMY! ALE NAZWIJCIE TO INACZEJ ABY NAZWA BYLA OGOLNIE ROZPOZNAWANA -->

## HTML
### Implementacja skryptów oraz stylizacji[^1]
#### Jakikolwiek kod CSS oraz JavaScript powinien być w odzielnym pliku. W kodzie HTML czy PHP nie powinno się znajdować żadnych wewnętrznych styli ani skryptów;
##### Przykład
```HTML
<head>
    <style></style>
</head>

<script> DoSomething() </script>
```

## PHP 
### Nazewnictwo
##### Każde zapytanie SQL wprowadzone w PHP-ie przed dodaniem do jakiejkolwiek funkcji MySQL powinno pozostać przypisane do zmiennej `$sql`.
### Utrzymywanie kodu w porządku
#### Jeżeli można to elementy dawać poza kodem PHP i wartości dodawać kodem wewnątrz elementu.
```PHP
<div id="<?php echo $result["entryid"]; ?>"><?php echo $_$GET["page"]; ?></div>
```
##### Zamiast:
```PHP
echo '<div id="' . $result["entryid"] . '">' . $_$GET["page"] . '</div>';
```
##### Wyjątkiem jest oczywiście gdy element ma być kilkukrotnie tworzony przez pętle itd.

## CSS
### Nazewnictwo
#### Wyrazy w nazwach klas powinny być rozdzielane znakiem '-' np. "centered-item"
#### Wszelkiego nazwy klas dla pojemników powinny być mieć w nazwie "\*nazwa\*-wrapper" zamiast "\*nazwa\*-container", np. "content-wrapper".
#### Właściwości oraz ich wartości powinny być pisane z małymi literami

### Utrzymywanie kodu w porządku
#### Po podaniu Selector-a elementu pomiędzy selektor-em, a klamrą powinnien być odstęp jednej spacji.
#### Klamry zawsze powinny mieć wcięcie do następnej lini, a w jednej lini powinna się znajdować maksymalnie jedna właściwość.
##### Przykład:
```CSS
.content-wrapper,
.details-wrapper {
    display: flex;
    gap: 2rem;
}
```

-----------------

Pozostałe
------
##### CSS:
###### Jako, że na stronie chcemy utrzymać resoponsywność mimo braku wsparcia dla urządzeń mobilnych na początek, zaleca się używania metod Flexbox czy Grid do ustawiania elementów na stronie oraz omijania inline-block czy pozycjonowania absolutnego/stałego.


[^1]: Dotyczy również PHP-a
