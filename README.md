# BrazilianPhoneValidator

This library is intended to simplify the validation of brazilian phone numbers.
All validations rules are based on Anatel specifications.

##What is Anatel

According to [Wikipedia](http://en.wikipedia.org/wiki/Brazilian_Agency_of_Telecommunications):
> "The National Telecommunications Agency (in Portuguese, Agência Nacional de Telecomunicações - Anatel) is a special agency in Brazil created by the general telecommunications act (Law 9472, 16/07/1997) in 1997. The agency is administratively and financially independent, and not hierarchically subordinate to any government agency."

## Setup

TODO: Setup

## Usage

###Validator

Responsible for validate a brazilian phone number.
It contains specific validation rules.

**Methods:**
- **isValid($phone) :** Checks if it is a valid brazilian phone number.
- **isValidCellphone($phone) :** Checks if it is a valid brazilian cellphone phone number.
- **isValidLandline($phone) :** Checks if it is a valid brazilian landline phone number.
- **isValidSMP($phone) :** Checks if it is a valid brazilian cellphone number and specifically from the SMP type.<br/>
*SMP - Serviço Móvel Pessoal (in English, Personal Mobile Service)*
- **isValidSME($phone) :** Checks if it is a valid brazilian cellphone number and specifically from the SME type.<br/>
*SME - Serviço Móvel Especializado (in English, Specialized Mobile Service)*
- **isValidSTFC($phone) :** Checks if it is a brazilian landline phone number and specifically from STFC type.<br/>
*STFC - Serviço Telefônico Fixo Comutado (in English, Landline Telephone Service)*

```php
<?php

$phoneValidator = new EmpregoLigado\BrazilianPhoneValidator\Validator();
$phone = "<PUT_THE_PHONE_NUMBER_HERE>"; //e.g. "11986111000"

// Checks if it is a valid brazilian phone number.
if (phoneValidator->isValid($phone)) {
    // success statement
} else {
    // error statement
}
```

### Creating/Updating the dataset files (Dataset Processor)

Responsible for create and update the dataset files (PHP and JSON) used by the validator class.
The dataset is generated based on the files provided by Anatel.

####Download the latest version from each type (SME, SMP and STFC)

**SME - Serviço Móvel Especializado (Specialized Mobile Service)**
http://sistemas.anatel.gov.br/sapn/ArquivosABR/faixaSME.asp?SISQSmodulo=18098

**SMP - Serviço Móvel Pessoal (Personal Mobile Service)**
http://sistemas.anatel.gov.br/sapn/ArquivosABR/faixaSMP.asp?SISQSmodulo=18099

**STFC - Serviço Telefônico Fixo Comutado (Landline Telephone Service)**
http://sistemas.anatel.gov.br/sapn/ArquivosABR/faixaSTFC.asp?SISQSmodulo=18100

* - NOTE: Usually, you should download the incremental version of the file,
but you can remove all the content from the data directory and create the 
dataset by yourself. In this case, start processing the general version of 
the file and its incremental files successively.*

####Processing the dataset

```php
$ php bin/generate-dataset.php ~/Downloads/FAIXA_SMP_20130803_0330_GERAL.txt data/
```

## License

TODO: License
