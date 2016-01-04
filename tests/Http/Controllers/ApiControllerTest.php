<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Girl;

class ApiControllerTest extends \TestCase
{
    protected $new_girl_id;

    public function testIfControllerExists()
    {
        $this->assertTrue(class_exists(ApiController::class), 'Class not exists!');
    }

    public function testShowAllGirlsArchievedInJsonFormat()
    {
        $girl = new Girl();
        $res = $girl->all()->toArray();
        $this->get('/girls')->seeJson();
        $this->get('/girls')->seeJsonEquals($res);
    }

    public function testShouldPostAndCreateNewGirl()
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
    public function testShouldDeleteAGirlUsingId()
    {
        $id = $this->new_girl_id;
        $this->seeInDatabase('girls', ['id' => $id]);
        $this->delete('/girls/'.$id)->seeJsonEquals(['deleted' => true]);
    }
}