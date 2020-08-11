<?php

namespace App\Support\Billing;

use CloudPayments\Exception;
use CloudPayments\Manager;

class CloudPaymentsManager extends Manager
{
    /**
     * @param $amount
     * @param $currency
     * @param $accountId
     * @param $token
     * @param $description
     * @param $email
     * @param $startDate
     * @param $interval
     * @param $period
     * @param array $params
     * @return mixed
     * @throws Exception\RequestException
     */
    public function createSubscription(
        $amount,
        $currency,
        $accountId,
        $token,
        $description,
        $email,
        $startDate,
        $interval,
        $period,
        $params = []
    )
    {
        $endpoint = '/subscriptions/create';
        $defaultParams = [
            'Amount'               => $amount,
            'Currency'             => $currency,
            'AccountId'            => $accountId,
            'Token'                => $token,
            'Description'          => $description,
            'Email'                => $email,
            'Require Confirmation' => false,
            'StartDate'            => $startDate,
            'Interval'             => $interval,
            'Period'               => $period
        ];

        $response = $this->sendRequest(
            $endpoint,
            array_merge(
                $defaultParams,
                $params
            )
        );

        if ($response['Success']) {
            return $response['Model'];
        }

        if ($response['Message']) {
            throw new Exception\RequestException($response);
        }

        throw new Exception\RequestException($response);
    }

    /**
     * @param $id
     * @param null $amount
     * @param null $currency
     * @param null $description
     * @param null $startDate
     * @param null $interval
     * @param null $period
     * @param array $params
     * @return mixed
     * @throws Exception\RequestException
     */
    public function updateSubscription(
        $id,
        $amount = null,
        $currency = null,
        $description = null,
        $startDate = null,
        $interval = null,
        $period = null,
        $params = []
    ) {
        $endpoint = '/subscriptions/update';

        $data = [
            'Id' => $id
        ];
        if ($amount !== null) {
            $data['Amount'] = $amount;
        }
        if ($currency !== null) {
            $data['Currency'] = $currency;
        }
        if ($description !== null) {
            $data['Description'] = $description;
        }
        if ($startDate !== null) {
            $data['StartDate'] = $startDate;
        }
        if ($interval !== null) {
            $data['Interval'] = $interval;
        }
        if ($period !== null) {
            $data['Period'] = $period;
        }

        $response = $this->sendRequest($endpoint, array_merge($params, $data));

        if ($response['Success']) {
            return $response['Model'];
        }

        if ($response['Message']) {
            throw new Exception\RequestException($response);
        }

        throw new Exception\RequestException($response);
    }

    /**
     * @param string $id
     * @throws Exception\RequestException
     * @return CloudPaymentsSubscription
     */
    public function getSubscription($id)
    {
        $endpoint = '/subscriptions/get';
        $params = [
            'Id' => $id
        ];

        $response = $this->sendRequest($endpoint, $params);

        if ($response['Success']) {
            return CloudPaymentsSubscription::fromArray($response['Model']);
        }

        if ($response['Message']) {
            throw new Exception\RequestException($response);
        }

        throw new Exception\RequestException($response);
    }

    /**
     * @param $accountId
     * @return array
     * @throws Exception\RequestException
     */
    public function getSubscriptions($accountId) // Example user@example.com - идентификатор аккаунта
    {
        $endpoint = '/subscriptions/find';
        $params = [
            'accountId' => $accountId
        ];

        $response = $this->sendRequest($endpoint, $params);

        if ($response['Success']) {
            $subscriptions = [];
            foreach ($response['Model'] as $subscription) {
                $subscriptions[] = CloudPaymentsSubscription::fromArray($subscription);
            }
            return $subscriptions;
        }

        if ($response['Message']) {
            throw new Exception\RequestException($response);
        }

        throw new Exception\RequestException($response);
    }

    /**
     * @param string $id
     * @throws Exception\RequestException
     * @return bool
     */
    public function cancelSubscription($id)
    {
        $endpoint = '/subscriptions/cancel';
        $params = [
            'Id' => $id
        ];

        $response = $this->sendRequest($endpoint, $params);

        if ($response['Success']) {
            return true;
        }

        if ($response['Message']) {
            throw new Exception\RequestException($response);
        }

        throw new Exception\RequestException($response);
    }
}