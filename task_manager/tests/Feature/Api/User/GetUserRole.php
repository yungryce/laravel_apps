<?php

it('has api/user/getuserrole page', function () {
    $response = $this->get('/api/user/getuserrole');

    $response->assertStatus(200);
});
