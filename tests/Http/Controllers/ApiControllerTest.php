<?php
namespace Tests\Http\Controllers;
use App\Http\Controllers\ApiController;
use App\Models\Girl;
class ApiControllerTest extends \TestCase
{
    /**
     * @TODO Assert for a real response instead of serialization.
     */
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
        $newGirlId = $lol->content();
        return $newGirlId;
    }

    /**
     * @depends testShouldPostAndCreateNewGirl
     * @TODO Remove dependency of another test.
     * @param $id
     */
    public function testShouldDeleteAGirlUsingId($id)
    {
        $this->seeInDatabase('girls', ['id' => $id]);
        $this->delete('/girls/'.$id)->seeJsonEquals(['deleted' => true]);
    }
}