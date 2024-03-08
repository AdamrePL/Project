<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/access.css">
    <title><?php echo SITENAME; ?> - Zaloguj / Zarejestruj</title>
</head>

<body>
    <div class="access-wrapper">
        <div id="login-wrapper" aria-selected="true">
            <h1>Logowanie</h1>
            <form method="post" action="../controllers/process-data.php" class="user-form">
                <input type="text" name="user-id" placeholder="ID użytkownika" />
                <input type="password" name="password" placeholder="Hasło (Jeżeli jest)" />
                <input type="submit" name="logowanie" value="Zaloguj">
            </form>
        </div>
        <div class="line"></div>
        <div id="register-wrapper" aria-selected="false">
            <h1>Rejestracja</h1>
            <form method="post" action="../controllers/process-data.php" class="user-form">
                <input type="text" name="username" placeholder="Nazwa użytkownika"/>
                <input type="email" name="email" placeholder="Adres e-mail"/>
                <input type="password" name="password" placeholder="Hasło (Opcjonalne)"/>
                <input type="password" name="password-repeat" placeholder="Potwierdzenie hasła"/>
                <input type="submit" value="Zarejestruj">
            </form>
        </div>
    </div>
</body>


<!-- autocomplete="off" autofocus autocomplete="username" inputmode="numeric" -->

'<h2>Last login: ' . date("H:i, d.m.Y", strtotime($row['last-login']))  . '</h2>';
            echo '<h2>Joined: ' . date("d.m.Y", strtotime($row['join-date'])) . '</h2>';
            $sql = "SELECT SUM(totalepisodes) AS total_sum FROM list";
            nav > *:hover,
nav > *:focus-visible {
    outline-offset: 1.5px;
    outline-color: transparent;
    color: white;
    text-decoration: underline;
}
input,
select,
textarea {
    border: none;
    outline: none;
    background: rgb(var(--secondary-button));
    color: rgb(var(--text));
    padding: 0.2rem 0.5rem;
    font-size: 1.5rem;
    border-bottom: 3px solid rgb(80, 0, 0);
    border-radius: 5px;
}input[type="number"] {
    width: fit-content;
}
input[type="submit"]:focus,
input[type="button"]:focus {
    outline: rgba(var(--primary-button), 0.8) solid 2px;
    outline-offset: 1.5px;
}
input::placeholder,
select::placeholder,
textarea::placeholder {
    text-transform: capitalize;
    color: rgba(var(--text), 0.45);
}
input:focus::placeholder {
    color: rgba(var(--text), 0.25);
}

input:not(:placeholder-shown) {
    border-color: rgb(var(--accent));
}
.footer {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    Padding: 0.5rem;
    
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 1%;
}

.footer * {
    text-align: center;
    word-wrap: break-word;
    /* word-break: break-word; */
    font-size: 0.95rem;
    padding: 0.2rem;
}

.footer p {
    flex-basis: 100%;
    padding: 0;
}
table {
    /* border: 1px solid black; */
    text-align: center;
    font-size: 1.5rem;
    border-collapse: collapse;
    width: 100%;
}
table tr:first-child {
    background: rgb(var(--primary-button))
}

tr {
    background: rgb(var(--primary-button), 0.95);
}

tr:nth-of-type(2n) {
    background: rgb(var(--accent));
}

td,
th {
    padding: 0.2rem 1rem;
}

:read-only / :read-write
:where
:in-range
:increment / :decrement
::first-letter / ::first-line
:any-link
:default
:empty / :blank
::target-text
