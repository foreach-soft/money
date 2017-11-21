<?php
require_once "vendor/autoload.php";

use Fes\Money\Money;
use Fes\Money\Currency\Currencies;
use Fes\Money\Currency\Converter\CurrencyConverter;
use Fes\Money\Currency\Converter\CurrencyRate;

shell_exec("\$PSDefaultParameterValues['*:Encoding'] = 'utf8'");

/**
 * @var Money[]
 */
$money = [
    'uzs_50000' => new Money(50000, new Currencies\Uzs()),
    'uzs_10000' => new Money(10000, new Currencies\Uzs()),
    'usd_100'   => new Money(100, new Currencies\Usd()),
    'eur_100'   => new Money(100, new Currencies\Eur()),
    'rub_1000'  => new Money(1000, new Currencies\Rub()),
];
$currencyRates['eur/usd'] = new CurrencyRate(Currencies\Eur::class, Currencies\Usd::class, 1.18);
$currencyRates['usd/rub'] = new CurrencyRate(Currencies\Usd::class, Currencies\Rub::class, 59.16);
$currencyRates['usd/uzs'] = new CurrencyRate(Currencies\Usd::class, Currencies\Uzs::class, 7850);
$currencyRates['eur/rub'] = new CurrencyRate(
    Currencies\Eur::class,
    Currencies\Rub::class,
    $currencyRates['eur/usd']->getRate() * $currencyRates['usd/rub']->getRate()
);
$currencyRates['eur/uzs'] = new CurrencyRate(
    Currencies\Eur::class,
    Currencies\Uzs::class,
    $currencyRates['eur/usd']->getRate() * $currencyRates['usd/uzs']->getRate()
);
$converters = [
    'rub' => new CurrencyConverter(new Currencies\Rub(), $currencyRates),
    'uzs' => new CurrencyConverter(new Currencies\Uzs(), $currencyRates),
];

foreach ($money as $bucks) {
    try {
        $converted = array_map(
            function (CurrencyConverter $converter) use ($bucks) {
                return $converter->convert($bucks);
            },
            $converters
        );

        foreach ($converted as $convertedBucks) {
            printf("Converter: %s -> %s \n", $bucks, $convertedBucks);
        }

    } catch (\Fes\Money\Exception\CurrencyRateNotExistException $ignore) {
        // ignore
    }
}
