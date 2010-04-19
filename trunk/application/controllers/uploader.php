<?php

require_once 'includes/Classes/PHPExcel/IOFactory.php';

class Uploader extends Controller
{
  function Uploader(){
    parent::Controller();
  }
  
  function index()
  {
    //$uploaddir = '/var/www/uploads/';
    $uploadType = $_POST['type'];
    
    if ($uploadType == "images")
    {
        $uploaddir  = echo base_url();."images/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
        {
            echo "success";
        } 
        else 
        {
            echo "error";
        }
    }
    elseif ($uploadType == "excel")
    {
        $uploaddir  = echo base_url();."tmp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
        $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);
        $count = 0;
        
        for ($i = 1; $i <= $objPHPExcel->getActiveSheet()->getHighestRow(); $i++)
        {
             $email = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
             $fname = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
             $lname = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
             $password = "testing123";
             $result = $this->users_model->addUser($email, $password, $fname, $lname);
             
             if ($result == '')
             {
                $count++;
             }
        }
        
        if ($count == 0)
        {
             $this->session->set_flashdata('type', 'message warning');
             $this->session->set_flashdata('msg', 'Users already exist in database');
        }
        else
        {
             $this->session->set_flashdata('type', 'message success');
             $this->session->set_flashdata('msg', $count.' users were added successfully!');
        }
        
        unlink($uploadfile);
        
        echo "success";
    }
    elseif ($uploadType == "resource")
    {
         $desc = $_POST['desc'];
         $course = $_POST['course'];
         $lecture = $_POST['lecture'];
         $lectureInfo = $this->lectures_model->getLectureInfo($lecture);
         $uploaddir  = echo base_url();."resources/";
         $path = $this->classes_model->getClassTitle($course).'/'.$lectureInfo->lectureTopic.'/';

         if(!file_exists($uploaddir.$this->classes_model->getClassTitle($course)))
         {
             mkdir($uploaddir.$this->classes_model->getClassTitle($course).'/');
         }
         
         if(!file_exists($uploaddir.$path))
         {
             mkdir($uploaddir.$path);
         }
         
         $uploadfile = $uploaddir . $path . basename($_FILES['userfile']['name']);
         move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
         $title = explode(".", basename($_FILES['userfile']['name']));
         $return = $this->lectures_model->addResource($lecture, $title[0], $desc, $uploadfile, $title[1]);
         
         if ($return)
         {
            echo "success";
         }
         else
         {
            echo "failure";
         }
    }
  }
}
?>