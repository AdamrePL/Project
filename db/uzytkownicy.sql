-- # Uprawnienia dla `usr_administrator`@`localhost`

GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO `usr_administrator`@`localhost` IDENTIFIED BY PASSWORD '*A29CF0C075EA5433194CE8D2E9DA3A81C8DD72EE';


-- # Uprawnienia dla `usr_gosc`@`localhost`

GRANT USAGE ON *.* TO `usr_gosc`@`localhost` IDENTIFIED BY PASSWORD '*8B93966B484AC360AC3C271B1CA4BEE8BC4DDFA8';

GRANT SELECT, INSERT ON `gielda`.* TO `usr_gosc`@`localhost`;


-- # Uprawnienia dla `usr_sprzedawca`@`localhost`

GRANT USAGE ON *.* TO `usr_sprzedawca`@`localhost` IDENTIFIED BY PASSWORD '*A297C80B0BF3D6B6FAAB4AC5F97C1D593476AAEB';

GRANT SELECT, INSERT, UPDATE ON `gielda`.* TO `usr_sprzedawca`@`localhost`;