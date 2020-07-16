<?php

class RepositoryControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testIfReturns200IfRepositoriesExist()
    {
        $this->get('/repositories/comparison?owner1=kgurda&repo1=final_project&owner2=kgurda&repo2=repository-comparator');
        $this->assertResponseStatus(200);
        $response = (array) json_decode($this->response->content());
        $this->assertArrayHasKey('categories', $response);
        $this->assertArrayHasKey('data', $response);
    }

    /**
     * @return void
     */
    public function testIfReturns404IfRepositoryDoesNotExist()
    {
        $notExistingRepo = 'repository-comparator-not-exist';
        $this->expectExceptionMessage("Github repository: $notExistingRepo not found");
        $this->get("/repositories/comparison?owner1=kgurda&repo1=final_project&owner2=kgurda&repo2=$notExistingRepo");
    }
}
