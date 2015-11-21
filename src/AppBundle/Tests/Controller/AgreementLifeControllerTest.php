<?php 

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AgreementLifeControllerTest
 */
class AgreementLifeControllerTest extends WebTestCase
{
    private function login($username = 'admin1@sfcrm.dev', $password = 'demo')
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign In')->form( array('_username' => $username, '_password' => $password));
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        return $client;
    }
    
    public function testAgreementLifeList()
    {
        $client = $this->login();
        $crawler = $client->request('GET', '/agreement/life/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Blank page', $client->getResponse()->getContent());
        $this->assertContains('Blank page', $crawler->filter('.content-header h1')->text());
        $this->assertGreaterThan(0, $crawler->filter('h1')->count());
        
    }
}
