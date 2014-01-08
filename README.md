twig-intl
=========

Twig extension for php intl.


## How to Install

#### Using [Composer](http://getcomposer.org/)

Create a composer.json file in your project root:

```json
{
    "require": {
        "smmoosavi/twig-intl": "dev-master"
    }
}
```

Then run the following composer command:

```bash
$ php composer.phar install
```
**Note**: *twig* will be installed with twig-intl too.

## How to use

Do everything required for [twig](http://twig.sensiolabs.org/doc/intro.html) and add following line:

```php
$twig->addExtension(new \smmoosavi\util\twigintl\Extension_Intl('fa_IR', 'persian')); // use your locale and calendar
```

Now you can use `lDateTime`, `lDate`, `lTime`,`lFormat`, `lNum` in your template.
### Complete example

```php
<?php // test.php
require_once '../vendor/autoload.php';

// initializing twig
$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);


// initializing twig-php-gettext
$twig->addExtension(new \smmoosavi\util\twigintl\Extension_Intl('fa_IR', 'persian'));

// using of twig-php-gettext
$test_date = new DateTime();
echo $twig->render("{{ lDateTime(test_date) }}", array('test_date' => $test_date));

```
## Reference

### Functions

* `lDate(test_date)`
* `lDateTime(test_date)`
* `lTime(test_date)`
* `lFormat(test_date)`
* `lNum(number)`

### Filters

* `test_date|lDateTime`
* `test_date|lDate`
* `test_date|lTime`
* `test_date|lFormat(format)`
* `number|lNum`

### Tags

* `locale`
* `endlocale`

#### Examples
Template:
```
functions:<br>
{{ lDateTime(test_date) }}<br>
{{ lTime(test_date)}}<br>
{{ lDate(test_date)}}<br>
{{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
{{lNum(3343.3)}}<br>
{{lNum(3343)}}<br>
{{lNum(-2)}}<br>
filters:<br>
{{ test_date|lDateTime }}<br>
{{ test_date|lTime }}<br>
{{ test_date|lDate }}<br>
{{ test_date|lFormat('y/M/d HH:mm (zzzz)') }}<br>
{{ 3343.3|lNum }}<br>
{{ 3343|lNum }}<br>
{{ (-2)|lNum }}<br>
```

Output:

```
functions:<br>
۱۳۹۲/۱۰/۱۸ ۱۵:۰۸<br>
۱۵:۰۸:۰۸<br>
چهارشنبه ۱۸ دی ۱۳۹۲<br>
۱۳۹۲/۱۰/۱۸ ۱۵:۰۸ (وقت عادی ایران)<br>
۳٬۳۴۳٫۳<br>
۳٬۳۴۳<br>
-۲<br>
filters:<br>
۱۳۹۲/۱۰/۱۸ ۱۵:۰۸<br>
۱۵:۰۸:۰۸<br>
چهارشنبه ۱۸ دی ۱۳۹۲<br>
۱۳۹۲/۱۰/۱۸ ۱۵:۰۸ (وقت عادی ایران)<br>
۳٬۳۴۳٫۳<br>
۳٬۳۴۳<br>
-۲<br>
```

Template:
```
ex1: {{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% locale -%}
    ex2: {{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% endlocale %}
{% locale 'fa_IR' -%}
    ex3: {{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% endlocale %}
{% locale 'fa_IR@persian' -%}
    ex4: {{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% endlocale %}
{% locale 'fa_IR@islamic@utc' -%}
    ex5: {{ lFormat(test_date,'EEEE d MMMM y HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% endlocale %}
{% locale 'fa_IR@null@utc' -%}
    ex6: {{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% endlocale %}
{% locale 'null@null@utc' -%}
    ex7: {{ lFormat(test_date,'y/M/d HH:mm (zzzz)')}}<br>
     {{lNum(3343.3)}}<br>
{% endlocale %}
```

Output:
```
ex1: ۱۳۹۲/۱۰/۱۸ ۱۵:۰۸ (وقت عادی ایران)<br>
     ۳٬۳۴۳٫۳<br>
ex2: 2014/1/8 15:08 (Iran Standard Time)<br>
     3,343.3<br>
ex3: ۲۰۱۴/۱/۸ ۱۵:۰۸ (وقت عادی ایران)<br>
     ۳٬۳۴۳٫۳<br>
ex4: ۱۳۹۲/۱۰/۱۸ ۱۵:۰۸ (وقت عادی ایران)<br>
     ۳٬۳۴۳٫۳<br>
ex5: چهارشنبه ۷ ربیع الاول ۱۴۳۵ ۱۱:۳۸ (GMT)<br>
     ۳٬۳۴۳٫۳<br>
ex6: ۲۰۱۴/۱/۸ ۱۱:۳۸ (GMT)<br>
     ۳٬۳۴۳٫۳<br>
ex7: 2014/1/8 11:38 (GMT)<br>
     3,343.3<br>
```
