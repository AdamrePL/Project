# Nazewnictwo
## PHP:
#### Każde zapytanie SQL wprowadzone w PHP-ie przed dodaniem do jakiejkolwiek funkcji MySQL powinno pozostać przypisane do zmiennej $sql.

## CSS:
#### Właściwości oraz ich wartości powinny być pisane z małymi literami

# Utrzymywanie kodu w porządku
## Implementacja skryptów oraz stylizacji
#### Jakikolwiek kod css oraz javascript powinien być w odzielnym pliku. W kodzie HTML czy PHP nie powinno się znajdować żadnych wewnętrznych styli ani skryptów



## PHP:
#### Jeżeli można to elementy dawać poza kodem PHP i wartości dodawać kodem wewnątrz elementu.
```PHP
    <div id="<?php echo $result["entryid"]; ?>"><?php echo $_$GET["page"]; ?></div>
```
##### Zamiast:
```PHP
    echo '<div id="' . $result["entryid"] . '">' . $_$GET["page"] . '</div>';
```
##### Wyjątkiem jest oczywiście gdy element ma być kilkukrotnie tworzony przez pętle itd.

----

## CSS:
