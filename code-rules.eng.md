<!-- TODO edit text formatting - remove unnecessary headers; they ruin the header list, which should divide the file into sections  -->

# **Standard coding practices for this project**
If you think that whatever is written here is too ridiculous and too much, then you should check out [these PHP coding standards](https://www.php-fig.org/psr/psr-2/ "Link to PHP coding standards").
Not to mention the fact, that the example above is quite old, meaning there's way less stuff inside than in the newer one. Besides, that's also the basic version. You've also got this [repo link](https://github.com/php-fig/fig-standards/tree/c2eaf724e984671db5c352ec34883e72ab9d4e83/accepted) where there's even more guidelines/rules.
Speaking of, I highly recommend checking out the 5th paragraph under the name `Control Structures` in `PSR-12-extended-coding-style-guide`, since it's also quite relevant to this project.

# Table of Contents
1. [Language](#general-language)
2. [Files](#files)
3. [Coding Languages](#coding-languages)
   - [HTML](#html)
       + [Implementation of scripts and stylization](#implementation-of-scripts-and-stylization)
       + [Keeping the code clean](#keeping-the-code-clean "Code readability HTML")
       + [Naming](#naming)
   - [CSS](#css)
       + [Naming](#naming-1)
       + [Keeping the code clean](#keeping-the-code-clean-1 "Code readability CSS")
       + [Other](#inne)
   - [PHP](#php)
       + [Naming](#naming-2)
       + [Keeping the code clean](#utrzymywanie-kodu-w-porządku-2 "Code readability PHP")
   - [JS](#js)
       + [Naming](#naming-3)
       + [Keeping the code clean](#keeping-the-code-clean-3 "Code readability JS")
4. [Other](#Other)

# General Language
### 

-----------------
# Files
### Naming Convention
**Files should be named in english.**
If a file name consits of multiple words, they should be seperated using '-'.

-----------------
# Coding Languages


## HTML
### Implementation of scripts and stylization
Any and all CSS/JavaScript code needs to be placed in a standalone file. There shouldn't be any internal styles or scripts inside of HTML or PHP files.
##### Example
```HTML
<head>
    <style></style>
</head>

<script> DoSomething() </script>
```

### Keeping the code clean
Nested elements should have a 4 whitespace indent. 
##### Example
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
Elements which don't have to be closed ex. `<input>`, should be closed with a slash at the end: `<input />`
Script referrals should be placed inside the `<head>` element and have the attributes `defer` or `async`, depending on how they're meant to be loaded.

> [!CAUTION]
> The site uses HTML5 elements.If an HTML5 element can be used for something, please do so.
> Do not use deprecated/old-fashioned HTML elements and attriutes ex. elements `center`, `small`/`big` or `strike` including attributes such as `size` and `colspan`.

### Naming Convention
All HTML elements should be written in lowercase; with the exception of custom defined elements

Nazwy jakichkolwiek elementów formularza, (które wymagają/potrzebują atrybutu nazwy) jeżeli składają się z przynajmniej 2 słow to muszą być rozdzielone za pomocą znaku "-".

Wyrazy w nazwach klas powinny być rozdzielane znakiem '-' np. "centered-item".

Wszelkiego nazwy klas dla pojemników powinny mieć w nazwie "-wrapper", "\*nazwa\*-wrapper" zamiast "\*nazwa\*-container", np. "content-wrapper".

## CSS
### Naming Convention
Variable names shouldn't begin with a digit, and should tell what it's being used for.

Unless it's something like `AaAaAaA`, you can name CSS variables however you want.

Element/Attribute/Value selectors should be written in lowercase.

### Keeping the code clean
Element selectors and their respective brackets should be seperated using a single whitespace.

If you're operating on multiple selectors at once, please use "," as a seperator. Transferring other selectors to new lines isn't necessary, but highly recommended.

There should be a maximum of **one** attribute per line.
#### Example
```CSS
.content-wrapper,
.details-wrapper {
    display: flex;
    gap: 2rem;
}
```

### Other
###### Since we want to keep the site responsive, despite the lack of mobile support at the beginning, it's advised to use Flexbox or Grid to align/order elements, aswell as the avoidance of inline-block or absolute/fixed positioning

## PHP 
### Naming Convention
Before getting assigned to a MySQL function, any SQL query should be assigned to an `$sql` variable.

> [!TIP]
> I recommend naming a variable $query for mysqli_query and $stmt for mysqli_stmt_prepare

The name of a function or a variable should be seperated with "_" if it consists of 2 or more words.

Variable names shouldn't start with digits or special characters.
They should also be named in a way, that tells which value they're holding.
#### Example
```php
$a = "password"; //This is an invalid variable name.
$password = "password"; //This is a valid variable name.
```
CONST type variables created using the keyword `const` or `define()` must consist of only uppercase letters and be compliant with PHP documentation.

### Keeping the code clean
**If it's able to be done, HTML elements should be defined outside of PHP, and any data contained inside them should be added using PHP.**
#### Example
```PHP
<div id="<?php echo $result["entryid"]; ?>"><?php echo $_$GET["page"]; ?></div>
```
Instead of:
```PHP
echo '<div id="' . $result["entryid"] . '">' . $_$GET["page"] . '</div>';
```

**Excluding cases where an element should be created multiple times by a loop, or when the site is divided into subsites using PHP without any referrals external files.**

## JavaScript
### Naming Convention
Function names (as long as they have one) should start with a lowercase letter

If the name of a function contains 2 or more words, they shouldn't be seperated, instead each new word should begin with an uppercase letter.[^1]

Variables - depending on their type requirements (const/let/var) - can have both uppercase and lowercase letters, **HOWEVER** if they contain 2 or more words, they must be seperated using the "_" sign

#### Example
```Js
function makeDiv() {
    let mydiv = document.createElement("div");
    mydiv.className = "centered";
    return mydiv;
}

const newtab = makeDiv()
```

> [!TIP]
> Variables dedicated to AJAX are to begin with "xhr" (+ number/meaningful word if there are multiple instances)

### Keeping the code clean

-----------------

Other
------
###### All indents should be made using 4 whitespaces, not tab.
###### **DO NOT USE EMOTES ANYWHERE INSIDE THE CODE** APART FROM ICONS / BUTTONS.

[^1]: [camelCase](https://en.wikipedia.org/wiki/Camel_case "Wikipedia link")
