<?php

namespace App\Services;
use App\Traits\ConsumesExternalService;
use GuzzleHttp\Psr7\Request;

/**
 * Class StudentService.
 */
class StudentService
{
    use ConsumesExternalService;
    public $baseUri;
	public $secret;
    public $studentId;

	public function __construct(){
		$this->baseUri = config('services.student.base_uri');
		$this->secret = config('services.student.secret');
	}
    public function getStudents($studentId){
    //    echo $studentId;
        return $this->performRequest('GET', '/api/v1/user/'.$studentId);
    }

    public function createstudent($data){
        // print_r($data);
        // die();
        return $this->performRequest('POST', '/api/v1/user/create', $data);
    }

    public function updatestudent($data){
        // print_r($data);
        // die();
        return $this->performRequest('POST', '/api/v1/user/update', $data);
    }

    public function deletestudent($studentId){
        //  print_r($studentId);
        // die();
        return $this->performRequest('DELETE', '/api/v1/user/delete/'.$studentId);
    }
    public function AsignTeacher($data){
        return $this->performRequest('POST', '/api/v1/user/asignTeacher', $data);

    }
}
