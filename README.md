Strona kodujdlapolski.pl - theme dla Wordpress
=====================

## Wymagania

Moduły PHP:
- php5-gd
- php5-curl

Dodatkowe biblioteki
- `apt-get install sendmail` (ewentualnie)

Dyrektywa vhost:
```
AllowOverride All
Options +FollowSymLinks +SymLinksIfOwnerMatch
```

Uprawnienia:
ustawić prawa do zapisu dla `www-data` do `wp-content`.

Wordpress: 
testowane na wersji 4.0.1

Wordpress pluginy:
- Advanced Custom Fields 4.3.9
- Advanced Custom Fields: Date & Time Picker 2.0.18.1
- Advanced Custom Fields: Repeater Field 1.1.1
- Akismet: 3.0.2
- Breadcrumb NavXT 5.1.1
- Formularze 4.0.1
- Map Cap 2.1
- Members 0.2.4
- Regenerate Thumbnails 2.2.4

wp-config.php:
- ustawić namiary na bazę danych
- ustawić namiary na mailer:
```
define('MAILER_USER', 'user@gmail.com');
define('MAILER_PASS', 'Password1');
```

