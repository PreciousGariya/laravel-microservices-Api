<?php

namespace App\Services;
use App\Traits\ConsumesExternalService;
use GuzzleHttp\Psr7\Request;

/**
 * Class TeacherService.
 */
class TeacherService
{
    use ConsumesExternalService;
    public $baseUri;
	public $secret;
    public $studentId;

	public function __construct(){
		$this->baseUri = config('services.teacher.base_uri');
		$this->secret = config('services.teacher.secret');
	}

    public function getteacher($teacherId){

        return $this->performRequest('GET', '/api/v1/teacher/'.$teacherId);
    }


    public function creatteacher($data){

        // print_r($data);
        // die();
        return $this->performRequest('POST', '/api/v1/teacher/create', $data);
    }

    public function updateTeacher($data){

        return $this->performRequest('POST', '/api/v1/teacher/update', $data);
    }

    public function deleteteacher($teacherId){
        return $this->performRequest('DELETE', '/api/v1/teacher/delete/'.$teacherId);
    }
}
