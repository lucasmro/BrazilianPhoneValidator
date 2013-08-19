<?php

/*
 * This file is part of BrazilianPhoneValidator.
 *
 * (c) Cardinal Tecnologia Ltda.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../src/EmpregoLigado/BrazilianPhoneValidator/Validator.php';

try {
    $phoneValidator = new EmpregoLigado\BrazilianPhoneValidator\Validator();
    
    if ($argc > 1) {
        $phone = $argv[1];
    } else {
        echo "Enter the phone number you want to validate: ";
        $phone = chop(fgets(STDIN));
    }
    
    $result = $phoneValidator->isValid($phone) ? "Yes" : "No";
    echo "Is a valid brazilian phone? " . $result . PHP_EOL;
    
    $result = $phoneValidator->isValidLandline($phone) ? "Yes" : "No";
    echo "Is a valid landline?        " . $result . PHP_EOL;
    
    $result = $phoneValidator->isValidCellphone($phone) ? "Yes" : "No";
    echo "Is a valid cellphone?       " . $result . PHP_EOL;
    
    $result = $phoneValidator->isValidSMP($phone) ? "Yes" : "No";
    echo "Is a valid SMP?             " . $result . PHP_EOL;
    
    $result = $phoneValidator->isValidSME($phone) ? "Yes" : "No";
    echo "Is a valid SME?             " . $result . PHP_EOL;
    
    $result = $phoneValidator->isValidSTFC($phone) ? "Yes" : "No";
    echo "Is a valid STFC?            " . $result . PHP_EOL;
    
    echo PHP_EOL;

    exit(0);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}