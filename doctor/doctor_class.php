<?php

class Doctor_class {

    public function __construct() {
        require_once '../db_connection.php';
    }

    public function get_profile_data() {
        @session_start();
        $id = $_SESSION['doc_id'];
        $sql = "select doctors.*,medical_center.medical_center_name,department.department from doctors join medical_center on medical_center.id = doctors.chamber_id join department on department.id=doctors.dept_id where doctors.id = $id ";

        $res = mysql_query($sql);
        $result = mysql_fetch_assoc($res);

        return $result;
    }
    public function update_profile_data($posted_data){
        if ($_FILES['image']['size']>0){
            $fileName=$_FILES["image"]["name"];
            $tmpName=$_FILES["image"]["tmp_name"];
            $image_info=pathinfo($fileName);
            $image_extension=$image_info["extension"];
            $new_file_name=time().'_'.rand(0,99999999).'.'.$image_extension;
            $upload_path='images/';
            $upload_success=move_uploaded_file($tmpName, $upload_path.$new_file_name);
            if($upload_success){
                $pro_pic=$new_file_name;
                $sql="UPDATE doctors
                SET pro_pic='$pro_pic'
                WHERE id='$_SESSION[doc_id]';";
                $res = mysql_query($sql);
                $_SESSION['doc_pro_pic']=$pro_pic;
                
            }
        }



        $name = $posted_data['doc_name'];
            $degree = $posted_data['degree'];
            $chamber = $posted_data['chamber'];
            $email = $posted_data['email'];
            $password = md5($posted_data['password']);


            $sql="UPDATE doctors
            SET doc_name='$name',degree='$degree',chamber_id='$chamber',email='$email',password='$password'
            WHERE id='$_SESSION[doc_id]';";
            $res = mysql_query($sql);

            if ($res) {
                $msg = "Successfully Updated";

                return $msg;
            }

    }

}
