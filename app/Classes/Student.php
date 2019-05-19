<?php

namespace App\Classes;

use App\Library\ImageUpload;
use App\Library\Validation;

class Student
{
    use Validation;

    public function add($data, $files)
    {
        $dataArr = array_merge($data, ['image'=>$files['image']['name']]);
        $required = $this->required($dataArr);
        $data = $this->filter($data);
        if (!empty($required)) {
            return $required;
        } else {
            $imgUpload = new ImageUpload;
            $img_directory = $imgUpload->image($files, 'image')
                    ->allowedExtention(['jpg', 'jpeg', 'png', 'JPG'])
                    ->upload('./uploads');
            $data = (object)$data;
            if (isset($_COOKIE['students'])) {
                $student_data = json_decode($_COOKIE['students']);
            }
            $student = ['id' => time(),'name'=>$data->name,'email'=>$data->email,
                        'address'=>$data->address,'image'=>$img_directory];
            $student_data[] = $student;
            $encode_data = json_encode($student_data);
            setcookie('students', $encode_data, time() + (60 * 60 * 24));
            header('Location: students.php');
        }

    }

    public function getStudents()
    {
        if (isset($_COOKIE['students'])) {
            $decode_data = json_decode($_COOKIE['students'], true);
            return $decode_data;
        }
    }

    public function update($data, $files)
    {
        $data = (object) $data;
        $imageName = $files['image']['name'];
        if (isset($_COOKIE['students'])) {
            $decode_data = json_decode($_COOKIE['students'], true);
            foreach ($decode_data as $key => $value) {
                if ($value['id'] == $data->id) {
                   $decode_data[$key]['name'] = $data->name;
                   $decode_data[$key]['email'] = $data->email;
                   $decode_data[$key]['address'] = $data->address;
                   if (!empty($imageName)) {
                       unlink($value['image']);
                       $imgUpload = new ImageUpload;
                       $img_directory = $imgUpload->image($files, 'image')
                                                    ->upload('./uploads');
                        $decode_data[$key]['image'] = $img_directory;
                   }
                }
            }
            $encode_data = json_encode($decode_data);
            setcookie('students', $encode_data, time() + (60 * 60 * 24));
            header('Location: students.php');
        }
    }

    public function getStudentById($id)
    {
        if (isset($_COOKIE['students'])) {
            $decode_data = json_decode($_COOKIE['students'], true);
            foreach ($decode_data as $key => $value) {
                if ($value['id'] == $id) {
                    return $value;
                }
            }
        }
    }

    public function delete($id)
    {
        if (isset($_COOKIE['students'])) {
            $decode_data = json_decode($_COOKIE['students'], true);
            $old_data = [];
            foreach ($decode_data as $key => $value) {
                if ($value['id'] == $id) {
                    unlink($value['image']);
                    unset($decode_data[$key]);
                    foreach ($decode_data as $k => $v) {
                        $old_data[] = $v;
                    }
                    $encode_data = json_encode($old_data);
                    setcookie('students', $encode_data, time() + (60 * 60 * 24));
                    header('Location: students.php');
                } 
            }
        }
    }

    public function deleteAll()
    {
        if (isset($_COOKIE['students'])) {
            $decode_data = json_decode($_COOKIE['students'], true);
            foreach ($decode_data as $key => $value) {
                unlink($value['image']);
            }
            setcookie('students', '', time() - 3600);    
        }
        header('Location: students.php');
    }

}