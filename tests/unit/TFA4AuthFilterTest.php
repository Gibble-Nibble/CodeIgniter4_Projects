<?php

use App\Filters\TFA4Auth;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class TFA4AuthFilterTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        service('session')->remove(['tfa4_user_id', 'tfa4_username']);
    }

    public function testRedirectsWhenSessionHasNoAuthenticatedUser(): void
    {
        $response = (new TFA4Auth())->before(service('request'));

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertStringEndsWith('/TFA4/login', $response->getHeaderLine('Location'));
    }

    public function testAllowsAuthenticatedUser(): void
    {
        service('session')->set('tfa4_user_id', 1);

        $this->assertNull((new TFA4Auth())->before(service('request')));
    }
}
