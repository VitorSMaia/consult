<?php

namespace App\Service\API;

use GuzzleHttp\Client;

class InsuranceCalculator
{
    private $link = 'https://viacep.com.br/ws/';
    private $client;

    public function fetchData($value, $config)
    {
        $value = floatval($value);

        $iof = $config['iof'];

        if($value <= 1520001.00) {
            $value_tax = $config['tax_default'];
        }elseif($value >= 1520001.00 && $value <= 3500000.00) {
            $tax = $config['tax_one'];
            $value_tax = $value * $tax;
        }elseif($value >= 3500001.00 && $value <= 6000000.00) {
            $tax = $config['tax_two'];
            $value_tax = $value * $tax;
        }elseif($value >= 6000001.00 && $value <= 10000000.00) {
            $tax = $config['tax_three'];
            $value_tax = $value * $tax;
        }elseif($value >= 10000001.00 && $value <= 20000000.00) {
            $tax = $config['tax_four'];
            $value_tax = $value * $tax;
        }elseif($value >= 20000001.00 && $value <= 50000000.00) {
            $tax = $config['tax_five'];
            $value_tax = $value * $tax;
        }else{
            $value_tax = 0;
        }

        $value_iof = ($value_tax / 100) * $iof;
        $value_total = $value_tax + $value_iof;

        $values = [
            'tax' => $value_tax,
            'value_iof' => $value_iof,
            'total' => $value_total,
            'origin' => $value,
        ];

        return $values;
    }
}