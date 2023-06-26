<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\indexGithub;

class githubController extends Controller
{
    public function fetchGithub(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.github.com/users/fliw/repos',[
            'headers' => [
                'Authorization' => 'Bearer '. env('GITHUB_TOKEN')
            ]
        ]);
        $data = $response->getBody();
        $data = json_decode($data);
        return response()->json([
            'data' => indexGithub::collection($data)
        ]);
    }
}
