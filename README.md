# iPag PHP client SDK

> A ferramenta certa para uma rápida e segura integração com o iPag e a sua aplicação PHP

**Índice**

- [iPag PHP client SDK](#ipag-php-client-sdk)
  - [Dependências](#dependências)
  - [Instalação](#instalação)
- [IpagClient](#ipag-client)
  - [Autenticação](#autenticação)
- [Cliente (Customer)](#cliente-customer)
  - [Novo Cliente](#novo-cliente)
  - [Alterar Cliente](#alterar-cliente)
  - [Obter Cliente](#obter-cliente)
  - [Listar Clientes](#listar-clientes)
  - [Deletar Cliente](#deletar-cliente)
- [Plano de Assinatura (Subscription Plan)](#plano-de-assinatura-subscription-plan)
  - [Novo Plano](#novo-plano-de-assinatura)
  - [Alterar Plano](#alterar-plano-de-assinatura)
  - [Obter Plano](#obter-plano-de-assinatura)
  - [Listar Planos](#listar-planos-de-assinatura)
  - [Deletar Plano](#deletar-plano-de-assinatura)
- [Assinatura (Subscription)](#assinatura)
  - [Nova Assinatura](#nova-assinatura)
  - [Alterar Assinatura](#alterar-assinatura)
  - [Obter Assinatura](#obter-assinatura)
  - [Listar Assinaturas](#listar-assinaturas)
  - [Desvincular Token da assinatura](#desvincular-token-da-assinatura)
  - [Quitar Parcela da Assinatura](#quitar-parcela-da-assinatura)
  - [Agendar Parcelamento](#agendar-parcelamento)
- [Transação (Transaction)](#transação-transaction)
  - [Obter Transação](#obter-transação)
  - [Listar Transações](#listar-transações)
  - [Liberar Recebíveis da Transação](#liberar-recebíveis-da-transação) (not implemented yet)
- [Token (Card Token)](#token-card-token)
  - [Novo Token](#novo-token)
  - [Obter Token](#obter-token)
- [Cobrança (Charge)](#cobrança-charge)
  -  [Nova Cobrança](#nova-cobrança)
  -  [Alterar Cobrança](#alterar-cobrança)
  -  [Obter Cobrança](#obter-cobrança)
  -  [Listar Cobranças](#listar-cobranças)
- [Transferência (Transfer)](#transferência-transfer)
  -  [Listar Transferências](#listar-transferências)
  -  [Obter Transferência](#obter-transferência)
  +  [Transferência dos Vendedores (Sellers Transfers)](#transferência-dos-vendedores-sellers-transfers)
     -  [Listar Transferências dos Vendedores](#listar-transferências-dos-vendedores)
     -  [Obter Transferência de Vendedor](#obter-transferência-de-vendedor)
  +  [Lançamentos Futuros (Future Transfers)](#lançamentos-futuros-future-transfers)
     - [Listar Lançamentos Futuros](#listar-lançamentos-futuros)
     - [Listar Lançamentos Futuros de Vendedor (Por Id)](#listar-lançamentos-futuros-de-vendedor-por-id)
     - [Listar Lançamentos Futuros de Vendedor (Por CPF/CNPJ)](#listar-lançamentos-futuros-de-vendedor-por-cpf-cnpj)
- [Link de Pagamento (Payment Links)](#link-de-pagamento-payment-links)
     - [Novo Link de Pagamento](#novo-link-de-pagamento)
     - [Obter Link de Pagamento (Por Id)](#obter-link-de-pagamento-por-id)
     - [Obter Link de Pagamento (Por External Code)](#obter-link-de-pagamento-por-external-code)
- [Testes](#testes)
- [Licença](#licença)
- [Documentação](#documentação)
- [Dúvidas \& Sugestões](#dúvidas--sugestões)

## Dependências

**require**

- [PHP >= 7.4]
- [guzzlehttp/guzzle]
- [kubinyete/assertation]
- [psr/log]
- [symfony/polyfill-php81]
- [symfony/polyfill-php80]

**require-dev**

- [phpunit/phpunit]
- [symfony/var-dumper]
- [fakerphp/faker]

## Instalação

Execute em seu shell:

    composer require ipagdevs/ipag-sdk-php

# IpagClient

Classe responsável pela integração com a API do iPag. Através dela você consegue acessar todos os endpoints disponíveis na API.

> Para mais informações de como funciona a autenticação no Ipag, consulte: [Autenticação Ipag](https://developers.ipag.com.br/pt-br/auth)

### Autenticação

```php
$ipagClient = new \Ipag\Sdk\Core\IpagClient(
    'apiID',
    'apiKey',
    IpagEnvironment::SANDBOX
);
```

# Cliente (Customer)

> Exemplo completo: [examples/customer/usage.php](./examples/customer/usage.php)

```php
$customer = new \Ipag\Sdk\Model\Customer([
    'name' => 'Maria da Silva',
    'email' => 'mariadasilva@email.com',
    'cpf_cnpj' => '799.993.388-01',
    'phone' => '(11) 98888-3333',
    'business_name' => 'Maria Ltda.',
    'address' => [
        'street' => 'Avenida Paulista',
        'number' => '01',
        'district' => 'São Paulo',
        'city' => 'São Paulo',
        'state' => 'SP',
        'zipcode' => '01310-930'
    ]
]);
```

ou

```php
$customer = new \Ipag\Sdk\Model\Customer()
    ->setName('Maria da Silva')
    ->setEmail('mariadasilva@email.com')
    ->setCpfCnpj('799.993.388-01')
    ->setPhone('(11) 98888-3333')
    ->setBusinessName('Maria Ltda.')
    ->setAddress(
        new \Ipag\Sdk\Model\Address()
            ->setStreet('Avenida Paulista')
            ->setNumber('01')
            ->setDistrict('São Paulo')
            ->setCity('São Paulo')
            ->setState('SP')
            ->setZipcode('01310-930')
);
```

### Novo Cliente

```php
$responseCustomer = $ipagClient->customer()->create($customer);
```

### Alterar Cliente

```php
$responseCustomer = $ipagClient->customer()->update($customer, 100001);
```

### Obter Cliente

```php
$responseCustomer = $ipagClient->customer()->get(100001);
```

### Listar Clientes

```php
$responseCustomer = $ipagClient->customer()->list([
    'name' => 'maria'
]);
```

### Deletar Cliente

```php
$ok = $ipagClient->customer()->delete(100001);
```

# Plano de Assinatura (Subscription Plan)

> Exemplo completo: [examples/subscription_plan/usage.php](./examples/subscription_plan/usage.php)

```php
$subscriptionPlan = new \Ipag\Sdk\Model\SubscriptionPlan([
    'name' => 'PLANO GOLD',
    'description' => 'Plano Gold com até 4 treinos por semana',
    'amount' => 0,
    'frequency' => 'monthly',
    'interval' => 1,
    'cycles' => 0,
    'best_day' => true,
    'pro_rated_charge' => true,
    'grace_period' => 0,
    'callback_url' => 'https://sualoja.com.br/ipag/callback',
    'trial' => [
        'amount' => 0,
        'cycles' => 0
    ]
]);
```

ou

```php
$subscriptionPlan = new \Ipag\Sdk\Model\SubscriptionPlan()
    ->setName("PLANO GOLD")
    ->setDescription("Plano Gold com até 4 treinos por semana")
    ->setAmount(99.00)
    ->setFrequency("monthly")
    ->setInterval(1)
    ->setCycles(0)
    ->setBestDay(true)
    ->setProRatedCharge(true)
    ->setGracePeriod(0)
    ->setCallbackUrl("https://sualoja.com.br/ipag/callback")
    ->setTrial(
        new \Ipag\Sdk\Model\Trial()
            ->setAmount(0)
            ->setCycles(0)
);
```

### Novo Plano de Assinatura

```php
$responseSubscriptionPlan = $ipagClient->subscriptionPlan()->create($subscriptionPlan);
```

### Alterar Plano de Assinatura

```php
$responseSubscriptionPlan = $ipagClient->subscriptionPlan()->update($subscriptionPlan, 1);
```

### Obter Plano de Assinatura

```php
$responseSubscriptionPlan = $ipagClient->subscriptionPlan()->get(1);
```

### Listar Planos de Assinatura

```php
$responseSubscriptionPlan = $ipagClient->subscriptionPlan()->list([
    'name' => 'PLANO SILVER',
]);
```

### Deletar Plano de Assinatura

```php
$ipagClient->subscriptionPlan()->delete(1);
```

# Assinatura (Subscription)

> Exemplo completo: [examples/subscription/usage.php](./examples/subscription/usage.php)

```php
$subscription = new \Ipag\Sdk\Model\Subscription([
    'is_active' => true,
    'profile_id' => 'SUB_018',
    'plan_id' => 2,
    'customer_id' => 100003,
    'starting_date' => '2021-07-11',
    'closing_date' => '2021-08-11',
    'callback_url' => 'https://minhaloja.com/callback',
    'creditcard_token' => null
]);

```

ou

```php
$subscription = new \Ipag\Sdk\Model\Subscription()
    ->setIsActive(true)
    ->setProfileId('SUB_001')
    ->setPlanId(1)
    ->setCustomerId(100001)
    ->setStartingDate('2021-07-10')
    ->setClosingDate('2021-08-10')
    ->setCallbackUrl('https://minhaloja.com/callback')
    ->setCreditcardToken('123');

```

### Nova Assinatura

```php
$responseSubscription = $ipagClient->subscription()->create($subscription);
```

### Alterar Assinatura

```php
$responseSubscription = $ipagClient->subscription()->update($subscription, $subscription_id);
```

### Obter Assinatura

```php
$responseSubscription = $ipagClient->subscription()->get($subscription_id);
```

### Listar Assinaturas

```php
$responseSubscription = $ipagClient->subscription()->list([
    'is_active' => true,
]);
```

### Desvincular Token da Assinatura

```php
$ok = $ipagClient->subscription()->unlinkToken($subscription_id);
```

### Quitar Parcela da Assinatura

```php
$responseSubscription = $ipagClient->subscription()->payOffInstallment($subscription_id, $invoice_number);
```

### Agendar Parcelamento da Assinatura

```php
$ok = $ipagClient->subscription()->scheduleInstallmentPayment($subscription_id, $invoice_number);
```

# Transação (Transaction)

> Exemplo completo: [examples/transaction/usage.php](./examples/transaction/usage.php)

### Obter Transação

```php
$responseTransaction = $ipagClient->transaction()->get($transaction_id);
```

### Listar Transações

```php
$responseTransaction = $ipagClient->transaction()->list([
    'order' => 'desc',
    'from_date' => '2023-08-29'
]);
```

### Liberar Recebíveis da Transação

```php

```

# Token (Card Token)

> Exemplo completo: [examples/token/usage.php](./examples/token/usage.php)

```php
$token = new \Ipag\Sdk\Model\Token([
    'card' => [
        'holderName' => 'Frederic Sales',
        'number' => '4024 0071 1251 2933',
        'expiryMonth' => '02',
        'expiryYear' => '2023',
        'cvv' => '431'
    ],
    'holder' => [
        'name' => 'Frederic Sales',
        'cpfCnpj' => '79999338801',
        'mobilePhone' => '1899767866',
        'birthdate' => '1989-03-28',
        'address' => [
                'street' => 'Rua dos Testes',
                'number' => '100',
                'district' => 'Tamboré',
                'zipcode' => '06460080',
                'city' => 'Barueri',
                'state' => 'SP'
            ]
    ]
]);
```
ou
```php
$token = (new \Ipag\Sdk\Model\Token())
    ->setCard(
        (new \Ipag\Sdk\Model\Card())
            ->setHolderName('Frederic Sales')
            ->setNumber('4024 0071 1251 2933')
            ->setExpiryMonth('02')
            ->setExpiryYear('2023')
            ->setCvv('431')
    )
    ->setHolder(
        (new \Ipag\Sdk\Model\Holder())
            ->setName('Frederic Sales')
            ->setCpfCnpj('79999338801')
            ->setMobilePhone('1899767866')
            ->setBirthdate('1989-03-28')
            ->setAddress(new \Ipag\Sdk\Model\Address)
    );
```

### Novo Token

```php
$responseToken = $ipagClient->token()->create($token);
```
### Obter Token

```php
$responseToken = $ipagClient->token()->get($token_value);
```

# Cobrança (Charge)

> Exemplo completo: [examples/charge/usage.php](./examples/charge/usage.php)

```php
$charge = new \Ipag\Sdk\Model\Charge([
    'amount' => 150.50,
    'description' => 'Cobrança referente a negociação de débito pendente na Empresa X',
    'due_date' => '2020-10-30',
    'frequency' => 1,
    'interval' => 'month',
    'type' => 'charge',
    'last_charge_date' => '2020-10-30',
    'callback_url' => 'https://api.ipag.test/retorno_charge',
    'auto_debit' => false,
    'installments' => 12,
    'is_active' => true,
    'products' => [1, 2, 3],
    'customer' => [
        'name' => 'Maria Francisca',
    ],
    'checkout_settings' => [
        'max_installments' => 12,
    ]
]);
```
ou
```php
$charge = (new \Ipag\Sdk\Model\Charge)
    ->setAmount(150.50)
    ->setDescription('Cobrança referente a negociação de débito pendente na Empresa X')
    ->setDueDate('2020-10-30')
    ->setFrequency(1)
    ->setInterval('month')
    ->setType('charge')
    ->setLastChargeDate('2020-10-30')
    ->setCallbackUrl('https://api.ipag.test/retorno_charge')
    ->setAutoDebit(false)
    ->setInstallments(12)
    ->setIsActive(true)
    ->setProducts([1, 2, 3])
    ->setCustomer(
        (new \Ipag\Sdk\Model\Customer)
            ->setName('Maria Francisca')
    )
    ->setCheckoutSettings(
        (new \Ipag\Sdk\Model\CheckoutSettings)
            ->setMaxInstallments(12)
    );
```

### Nova Cobrança

```php
$responseCharge = $ipagClient->charge()->create($charge);
```

### Alterar Cobrança

```php
$responseCharge = $ipagClient->charge()->update($charge, $charge_id);
```

### Obter Cobrança

```php
$responseCharge = $ipagClient->charge()->get($charge_id);
```

### Listar Cobranças

```php
$responseCharge = $ipagClient->charge()->list([
    'is_active' => false,
]);
```

# Transferência (Transfer)

> Exemplo completo: [examples/transfer/usage.php](./examples/transfer/usage.php)

### Listar Transferências

```php
$responseTransfers = $ipagClient->transfer()->list();
```

### Obter Transferência

```php
$responseTransfers = $ipagClient->transfer()->get($transfer_id);
```

## Transferência dos Vendedores (Sellers Transfers)

### Listar Transferências dos Vendedores

```php
$responseTransfers = $ipagClient->transfer()->seller()->list();
```

### Obter Transferência de Vendedor

```php
$responseTransfers = $ipagClient->transfer()->seller()->get($transfer_id);
```

## Lançamentos Futuros (Future Transfers)

### Listar Lançamentos Futuros

```php
$responseTransfers = $ipagClient->transfer()->future()->list();
```

### Listar Lançamentos Futuros de Vendedor (Por Id)

```php
$responseTransfers = $ipagClient->transfer()->future()->listBySellerId($seller_id);
```

### Listar Lançamentos Futuros de Vendedor (Por CPF/CNPJ)

```php
$responseTransfers = $ipagClient->transfer()->future()->listBySellerCpfCnpj($seller_cpf);
```

## Link de Pagamento (Payment Links)

> Exemplo completo: [examples/payment_links/usage.php](./examples/payment_links/usage.php)

```php
$paymentLink = new \Ipag\Sdk\Model\PaymentLink([
    'external_code' => '131',
    'amount' => 0,
    'description' => 'LINK DE PAGAMENTO SUPER BACANA',
    'expireAt' => '2020-12-30 23:00:00',
    'buttons' => [
        'enable' => false,
    ],
    'checkout_settings' => [
        'max_installments' => 12,
    ],
]);
```
ou
```php
$paymentLink = (new \Ipag\Sdk\Model\PaymentLink)
    ->setExternalCode('131')
    ->setAmount(0)
    ->setDescription('LINK DE PAGAMENTO SUPER BACANA')
    ->setExpireAt('2020-12-30 23:00:00')
    ->setButtons(
        (new \Ipag\Sdk\Model\Buttons)
            ->setEnable(false)
    )
    ->setCheckoutSettings(
        (new \Ipag\Sdk\Model\CheckoutSettings)
            ->setMaxInstallments(12)
    );
```

### Novo Link de Pagamento

```php
$responsePaymentLink = $ipagClient->paymentLinks()->create(new \Ipag\Sdk\Model\PaymentLink);
```

### Obter Link de Pagamento (Por Id)

```php
$responsePaymentLink = $ipagClient->paymentLinks()->getById($paymentLink_id);
```

### Obter Link de Pagamento (Por External Code)

```php
$responsePaymentLink = $ipagClient->paymentLinks()->getByExternalCode($external_code);
```

## Testes

É necessário a instalação do PHPUnit para a realização dos testes.

## Licença

[The MIT License](https://github.com/ipagdevs/ipag-sdk-php/blob/master/LICENSE)

## Documentação

[Documentação Oficial](https://developers.ipag.com.br)

## Dúvidas & Sugestões

Em caso de dúvida ou sugestão para o SDK abra uma nova [Issue](https://github.com/ipagdevs/ipag-sdk-php/issues).
