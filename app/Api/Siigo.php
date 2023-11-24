<?php

namespace App\Api;

use GuzzleHttp\Client as GuzzleClient;
use App\Models\{Log as ModelLog};
use GuzzleHttp\Exception\ClientException;

class Siigo
{

	protected $URL_BASE;
	protected $general;

	public function __construct() {
		$this->URL_BASE =  config('settings.url_api_siigo');
	}  
	
	public function createProductTInSiigo($data){
		$url = $this->URL_BASE . '/v1/products';
		$response = $this->executeApi($url, 'POST', $data);
		
		return $response;
	}

	public function updateProductTInSiigo($data, $idSiigo){
		$url = $this->URL_BASE . '/v1/products/' . $idSiigo;
		
		return $this->executeApi($url, 'PUT', $data);
	}
	
	public function deleteProductTInSiigo($idSiigo){
		$url = $this->URL_BASE . '/v1/products/' . $idSiigo;
		
		return $this->executeApi($url, "DELETE");
	}

	/**
     * Actualizar el stock de los productos
     * @param  string $code Referencia unica del Producto
     * @param  int 	  $quantity Cantidad del Producto
     * @param  string $movement_1 Debit/Credit
     * @param  string $movement_2 Debit/Credit
	 * @return object
	*/
	public function sendAccountantDocument($code, $quantity, $movement_1, $movement_2){
		$dataSendToSiigo= [
			'document' => [
				'id' => '24467'
			],
			'date' => date('Y-m-d'),
			'items' => [
				[
					'account' => [
						'code' => '61350510',
						'movement' => $movement_1
					],
					'customer' => [
						'identification' => '70813395',
						'branch_office' => '0'
					],
					'product' => [
						'code' => $code,
						'quantity' => $quantity
					],
					'description' => $movement_1 . ' / Inventario productos',
					'value' => 0  
				],
				[
					'account' => [
						'code' => '1105050101',
						'movement' => $movement_2
					],
					'customer' => [
						'identification' => '70813395',
						'branch_office' => '0'
					],
					'description' => $movement_2 . ' / Inventario productos',
					'value' => 0  
				],
			]
		];

		$url = $this->URL_BASE . '/v1/journals';

		return $this->executeApi($url, "POST", $dataSendToSiigo);
	}

	//Ejecuta todas las peticiones a la API 
	public function executeApi($url, $method, $data = []){
		//session()->forget('token');
		if(session()->has('token')){
			$timeNow = time();
			$dataToken = session()->get('token');
			$oldtime= $dataToken['time'];
			$dif = $timeNow - $oldtime;
			$minutes = $dif/60;
			if($minutes > 86399){
				$token = $this->getToken();
				$timeNow = time();
				$dataToken['token'] = $token;
				$dataToken['time']= $timeNow;
				session()->put('token', $dataToken);
			}else{
				$dataToken= session()->get('token');
				$token = $dataToken['token'];
			}
		}else{			
			$token = $this->getToken();
			$timeNow = time();
			$dataToken['token'] = $token;
			$dataToken['time']= $timeNow;
			session()->put('token', $dataToken);			
		}
		$error = false;
		$headers = [
			'Content-Type' 	=> 'application/json',
			'Authorization' => "Bearer {$token}",
		];
		$client = new GuzzleClient([
			'verify' => false,
			'headers' => $headers
		]);

		if ($method == 'POST' || $method == 'PUT') {
			try{
				$request = $client->request($method, $url,
					[
						'body' => json_encode($data)
					]
				);				
			}catch(\GuzzleHttp\Exception\ClientException $e){
				//dd($e->getMessage());
				$error  = json_encode($e->getMessage());
			}
		}elseif($method == 'DELETE'){
			try {
				$request =  $client->request('DELETE', $url);
			} catch (ClientException $e) {
				$error = true;
			}			
		}else{
			try {
				$request =  $client->request('GET', $url, $data);
			} catch (ClientException $e) {
				$error = true;
			}
		}
		$response['error'] = $error;
		$response['content'] = !$error ? json_decode($request->getBody()->getContents()) : $error;
		$dataLog['url'] = $url;
		$dataLog['response'] = json_encode($response);
		$dataLog['request'] = json_encode($data);
		ModelLog::create($dataLog);

		return (Object) $response;
	}

	private function getToken(){
		$headers = [
			'Content-Type' 	=> 'application/json',
		];
		$data= [
			"username" =>  config('settings.username_siigo'),
			"access_key" =>  config('settings.access_key_siigo'),
		];
		$client = new GuzzleClient([
			'verify' => false,
			'headers' => $headers
		]);
		try{
			$request = $client->request('POST', $this->URL_BASE . '/auth',
				[
					'body' => json_encode($data)
				]
			);				
		}catch(ClientException $errorException){
			$error  = $errorException;
			
		}

		$request= json_decode($request->getBody()->getContents());

		return $request->access_token;
	}
}