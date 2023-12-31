<?php declare(strict_types=1);
include_once(__DIR__ . "/tblBase.php");

class ctlBase {
    protected tblBase $table;

    public function __construct() {
    }

    public function ProcessRequest($requestMethod, $Key) {
        switch ($requestMethod) {
            case 'GET':
                if ($Key) {
                    $response = $this->GetByKey($Key);
                } else if (count($_GET) > 0) {
                    $response = $this->GetByFilter($_GET);
                } else {
                    $response = $this->Get();
                };
                break;
            case 'POST':
                $response = $this->Create();
                break;
            case 'PUT':
                $response = $this->Update();
                break;
            case 'DELETE':
                if ($Key) {
                    $response = $this->Delete($Key);
                }
                break;
            default:
                $response = $this->NotFound();
                break;
        }
        if(!$response) {
            $this->Unprocessable();
        } else {
            header($response['status_code_header']);
            if ($response['body']) {
                echo $response['body'];
            }
        }
    }

    private function Get(): array {
        $result = $this->table->GetAll();
        if (!$result) {
            return $this->NotFound();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function GetByKey($key): array {
        $result = $this->table->GetByKey($key);
        if (!$result) {
            return $this->NotFound();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function GetByFilter($filters): array {
        $result = $this->table->GetByFilter($filters);
        if (!$result) {
            return $this->NotFound();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function Create(): array {
        $data = $_POST;
        if (! $this->Validation($data)) {
            return $this->Unprocessable();
        }

        if($this->table->Create($data)) {
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = $this->table->dbError;
        }
        return $response;
    }

    private function Update(): array {
        $data = $this->PUT_Data();
        if (! $this->Validation($data)) {
            return $this->Unprocessable();
        }
        if($this->table->Update($data)) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
        } else {
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
        }
        $response['body'] = null;
        return $response;
    }

    private function Delete($key): array {
        $result = $this->table->GetByKey($key);
        if (!$result) {
            return $this->NotFound();
        }
        if($this->table->Delete($key)) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
        } else {
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
        }
        $response['body'] = null;
        return $response;
    }

    private function PUT_Data(): array {
        $lines = file('php://input');
        $keyLinePrefix = 'Content-Disposition: form-data; name="';

        $PUT = [];

        $mySubject = null;

        foreach($lines as $num => $line) {
            if (str_contains($line, $keyLinePrefix)) {
                $mySubject = substr($line, 38, -3);
            } else if (!is_null($mySubject) && strlen(trim($line)) > 0) {
                $PUT[$mySubject] = trim($line);
                $mySubject = null;
            }
        }

        return $PUT;

    }

    protected function Validation($input): bool {
        return true;
    }

    protected function Unprocessable(): array {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    protected function NotFound(): array {
        $response['status_code_header'] = 'HTTP/1.1 204 No Content';
        $response['body'] = null;
        return $response;
    }
}
