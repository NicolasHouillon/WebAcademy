<?php

namespace App\Services;

use App\Models\Course;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalHttp\HttpResponse;

class PaypalService
{

    private PaypalHttpClient $client;
    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->clientId = env('PAYPAL_SANDBOX_API_CLIENT');
        $this->clientSecret = env('PAYPAL_SANDBOX_API_SECRET');

        $environment = new SandboxEnvironment($this->clientId, $this->clientSecret);
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder(Course $course): HttpResponse
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken()
        ];
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $course->name,
                "amount" => [
                    "value" => $course->price,
                    "currency_code" => "EUR"
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('cancel.payment'),
                "return_url" => route('success.payment')
            ]
        ];

        return $this->client->execute($request);
    }

    private function getAccessToken(): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->getAuthorizationToken());
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);
        $err = curl_error($ch);

        if ($err) {
            echo "cURL Error #:" . $err;
            exit(1);
        } else {
            $json = json_decode($result);
            return $json->access_token;
        }
    }

    /**
     * @return string
     */
    private function getAuthorizationToken(): string
    {
        return $this->clientId . ":" . $this->clientSecret;
    }

    public function getOrderDetails(string $id)
    {
        $request = new OrdersGetRequest($id);
        return $this->client->execute($request);
    }

}
