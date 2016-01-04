<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Girl;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $new_girl_id;

    public function testShowAllGirlsArchievedInJsonFormat()
    {
        // Test setup
        $expectedResponse = new JsonResponse([], 200);

        $girlServiceMock = $this->getMock('App\Services\GirlServiceInterface');
        $girlServiceMock->expects($this->once())
            ->method('getAll')
            ->will($this->returnValue(array()));

        $controller = new ApiController($girlServiceMock);

        // Test execution
        $response = $controller->allGirls();

        // Test assertion
        $this->assertEquals($expectedResponse, $response);
    }

    public function xtestShouldPostAndCreateNewGirl()
    {
        $new = [
            'name' => 'new girl',
            'cover_photo' => 'in somewhere...',
            'photo_source' => 'www.fff.fff.com'
        ];
        $new2 = array_merge($new, ['_token' => csrf_token()]); // necessário no Lumen/Laravel
        $lol = $this->call('POST', '/girls', $new);
        $this->assertTrue($lol->isOk());
        $this->seeInDatabase('girls', $new);
        $this->new_girl_id = $lol->content();
    }

    /**
     * Esse último teste falha em função do teste superior. Não há
     * qualquer referência ao id do novo registro inserido pelo teste
     * Não sei se isso é proposital ou se foi alguma cagada minha.
     */
    public function xtestShouldDeleteAGirlUsingId()
    {
        $id = $this->new_girl_id;
        $this->seeInDatabase('girls', ['id' => $id]);
        $this->delete('/girls/'.$id)->seeJsonEquals(['deleted' => true]);
    }
}
