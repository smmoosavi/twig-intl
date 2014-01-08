<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 1/7/14
 * Time: 10:24 AM
 */

require_once '../vendor/autoload.php';

$test_date = new DateTime();

$f1 = new smmoosavi\util\Localization();
echo $f1->lDate($test_date) . "\n";
echo $f1->lDateTime($test_date) . "\n";
echo $f1->lTime($test_date) . "\n";
echo $f1->lFormat($test_date, 'y/M/d HH:mm (zzzz)') . "\n\n\n";

$f2 = new smmoosavi\util\Localization('fa_IR');
echo $f2->lDate($test_date) . "\n";
echo $f2->lDateTime($test_date) . "\n";
echo $f2->lTime($test_date) . "\n";
echo $f1->lFormat($test_date, 'y/M/d HH:mm (zzzz)') . "\n\n\n";

$f3 = new smmoosavi\util\Localization('fa_IR', 'persian');
echo $f3->lDate($test_date) . "\n";
echo $f3->lDateTime($test_date) . "\n";
echo $f3->lTime($test_date) . "\n";
echo $f1->lFormat($test_date, 'y/M/d HH:mm (zzzz)') . "\n\n\n";


$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);
$twig->addExtension(new \smmoosavi\util\twigintl\Extension_Intl('fa_IR', 'persian'));


echo "example lDate function:\n";
echo $twig->render("
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
", array('test_date' => $test_date));




echo "\n\n";
echo $twig->render("
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
", array('test_date' => $test_date));
echo "\n\n";
