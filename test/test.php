<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 1/7/14
 * Time: 10:24 AM
 */

require_once '../vendor/autoload.php';

$d = new DateTime();

$f1 = new smmoosavi\util\Localization();
echo $f1->lDate($d) . "\n";
echo $f1->lDateTime($d) . "\n";
echo $f1->lTime($d) . "\n";
echo $f1->lFormat($d,'y/M/d HH:mm (zzzz)') . "\n\n\n";

$f2 = new smmoosavi\util\Localization('fa_IR');
echo $f2->lDate($d) . "\n";
echo $f2->lDateTime($d) . "\n";
echo $f2->lTime($d) . "\n";
echo $f1->lFormat($d,'y/M/d HH:mm (zzzz)') . "\n\n\n";

$f3 = new smmoosavi\util\Localization('fa_IR','persian');
echo $f3->lDate($d) . "\n";
echo $f3->lDateTime($d) . "\n";
echo $f3->lTime($d) . "\n";
echo $f1->lFormat($d,'y/M/d HH:mm (zzzz)') . "\n\n\n";


$locale = 'fa_IR';
$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);
$twig->addExtension(new \smmoosavi\util\twigintl\Extension_Intl('fa_IR','persian'));


echo "example lDate function:\n";
echo $twig->render("
{{ lDateTime(test_date) }}<br>
{% locale %}{{lDateTime(test_date)}}{% endlocale%}<br>
{{ lDateTime(test_date) }}<br>
{% locale 'fa_IR' %}{{lDateTime(test_date)}}{% endlocale%}<br>
{% locale 'fa_IR@islamic' %}{{lDate(test_date)}}{% endlocale%}<br>
{% locale 'en_US@persian' %}{{lDateTime(test_date)}}{% endlocale%}<br>
{% locale 'fa_IR@persian@utc' %}
    {{lDateTime(test_date)}}<br>
    {{lDate(test_date)}}<br>
{% endlocale%}
", array('test_date' => $d));
echo "\n\n";
