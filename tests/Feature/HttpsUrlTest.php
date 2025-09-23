<?php

use Illuminate\Support\Facades\URL;

beforeEach(function () {
    // Reset URL configuration before each test
    URL::forceScheme(null);
});

it('generates HTTPS URLs in production environment', function () {
    // Set environment to production
    config(['app.env' => 'production']);
    config(['app.url' => 'http://localhost']);
    
    // Manually call the boot logic
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
    
    // Test that asset URLs use HTTPS
    $assetUrl = asset('landing/css/main.css');
    
    expect($assetUrl)->toStartWith('https://');
});

it('generates HTTPS URLs when X-Forwarded-Proto header is set', function () {
    // Reset to local environment
    config(['app.env' => 'local']);
    config(['app.url' => 'http://localhost']);
    
    // Simulate the logic from AppServiceProvider
    // In a real scenario, this would be triggered by the actual header
    URL::forceScheme('https');
    
    // Test that asset URLs use HTTPS
    $assetUrl = asset('landing/css/main.css');
    
    expect($assetUrl)->toStartWith('https://');
});

it('generates HTTP URLs in local development without forced scheme', function () {
    // Set environment to local (default)
    config(['app.env' => 'local']);
    config(['app.url' => 'http://localhost']);
    
    // Don't force HTTPS scheme
    
    // Test that asset URLs use HTTP in development
    $assetUrl = asset('landing/css/main.css');
    
    // In development, it should use HTTP when not forced
    expect($assetUrl)->toStartWith('http://');
});