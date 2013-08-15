<?php

namespace EmpregoLigado\BrazilianPhoneValidator;

class Validator
{
    const TYPE_SMP = 'smp';
    const TYPE_SME = 'sme';
    const TYPE_STFC = 'stfc';

    private static $dataset;

    public function __construct(array $dataset = array())
    {
        if (count($dataset)) {
            self::$dataset = $dataset;
        }
    }

    public function isValid($phone)
    {
        return $this->isValidSMP($phone) || $this->isValidSME($phone) || $this->isValidSTFC($phone);
    }

    public function isValidSMP($phone)
    {
        return $this->isValidRange($phone, self::TYPE_SMP);
    }

    public function isValidSME($phone)
    {
        return $this->isValidRange($phone, self::TYPE_SME);
    }

    public function isValidSTFC($phone)
    {
        return $this->isValidRange($phone, self::TYPE_STFC);
    }

    public function isValidCellphone($phone)
    {
        return $this->isValidSMP($phone) || $this->isValidSME($phone);
    }

    public function isValidLandline($phone)
    {
        return $this->isValidSTFC($phone);
    }

    private function isValidRange($phone, $type)
    {
        $phone = trim($phone);
        $phoneLength = strlen($phone);

        if (!is_numeric($phone) || $phoneLength > 11 || $phoneLength < 10) {
            throw new \InvalidArgumentException('The phone value must be a string with 10 or 11 characters length.');
        }

        $prefixEnd = $phoneLength === 10 ? 4 : 5;
        $rangeStart = $phoneLength === 10 ? 6 : 7;

        $areaCode = substr($phone, 0, 2);
        $prefix = substr($phone, 2, $prefixEnd);
        $phoneRange = substr($phone, $rangeStart);

        if (!isset(self::$dataset[$type])) {
            $this->loadDataset($type);
        }

        if (!isset(self::$dataset[$type][$areaCode][$prefix])) {
            return false;
        }

        foreach (self::$dataset[$type][$areaCode][$prefix] as $range) {
            list($initial, $final) = explode('-', $range);

            if ($phoneRange >= $initial && $phoneRange <= $final) {
                return true;
            }
        }

        return false;
    }

    private function loadDataset($type)
    {
        self::$dataset[$type] = require __DIR__.'/../../../data/dataset.'.$type.'.php';
    }
}
