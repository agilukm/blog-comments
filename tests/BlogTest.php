<?php 
use Test\TestCase;
use AlbertCht\Lumen\Testing\Concerns\InteractsWithRedis;
use AlbertCht\Lumen\Testing\Concerns\WithFaker;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;
class BlogTest extends AlbertCht\Lumen\Testing\TestCase
{
	public function testBrowse()
	{
		$response =	$this->call('get','/comments?filter[author][like]=me');
		$response->assertStatus(200);					
	}


	public function testRead()
	{
		$response = $this->call('get','/comments/'.App\Services\Comment\Comment::all()->random()->id);
		$response->assertStatus(200);	
	}


	public function testAdd()
	{		
		$response = $this->call('post','/comments/',['data'=>['name'=>'Some Name','website'=>'www.aniqma.com','email'=>'aniqma@aniqma.com','message'=>'aniqma','post_id'=>'1']]);		
		$response->assertStatus(200);			
	}

	public function testEdit()
	{
		$response = $this->call('patch','/comments/2',['data'=>['name'=>'Name some','website'=>'www.site.com','email'=>'gmail@aniqma.com','message'=>'test message','post_id'=>'2']]);
		$response->assertStatus(200);
	}

	public function testDelete()
	{
		$response = $this->call('delete','/comments/',['data'=>[['id'=>3]]]);
		$response->assertStatus(200);
	}

	//its done
}
