<?php

it('has api/user/assignrole page', function () {
    $response = $this->get('/api/user/assignrole');

    $response->assertStatus(200);
});
