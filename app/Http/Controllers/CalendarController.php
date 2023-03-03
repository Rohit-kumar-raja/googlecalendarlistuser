<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('calendar.callback'));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

        $authUrl = $client->createAuthUrl();
        return view('calendar.index', compact('authUrl'));
    }

    public function callback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('calendar.callback'));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

        $code = $request->get('code');
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);
        $events = $service->events->listEvents('primary');

        return view('calendar.events', compact('events'));
    }
}
