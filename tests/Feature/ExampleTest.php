<?php

it('returns a successful response', function () {
    // page d'accueil accessible
    $response = $this->get('/');

    // verifie le statut HTTP
    $response->assertStatus(200);
});
