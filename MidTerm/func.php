<?php
require_once "const.php";
if(!function_exists("db_connect")){
    function db_connect(){
    if($link = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB)){
        return $link;
    }
    else{
        die("DB connection has failed");
    }
    }
}
if(!function_exists("enter_post")){
    function enter_post($link, $uid, $post_image, $title, $text){
        $sql_query = "INSERT INTO posts(uid, pic, title, text) VALUES ('$uid', '$post_image', '$title', '$text')";
        if($query1 = mysqli_query($link, $sql_query)){     
            if(mysqli_affected_rows($link) > 0){
                return mysqli_insert_id($link);
            }
        }
    }
}
if (!function_exists("get_post")){
    function get_post($link){
        $sql_get = "SELECT * FROM posts";
        if($result = mysqli_query($link, $sql_get)){
            $arr_posts = [];
            while($row = mysqli_fetch_assoc($result)){
                $arr_posts[] = $row;
                
            }
        }
        return $arr_posts;
    }
}
if(!function_exists("image_post")){
    function image_post($link, $uid, $title, $text){
        $sql_query = "INSERT INTO posts(uid, title, text) VALUES ('$uid', '$title', '$text')";
        if($query1 = mysqli_query($link, $sql_query)){     
            if(mysqli_affected_rows($link) > 0){
                return mysqli_insert_id($link);
            }
        }
    }
}
if(!function_exists("edit_post")){
    function edit_post($link, $id, $uid, $image, $title, $text){
        $sql_query = "UPDATE posts SET uid = '$uid', pic = '$image', title = '$title', text = '$text' WHERE id = '$id' AND uid = '$uid'";
        if($query1 = mysqli_query($link, $sql_query)){     
            if(mysqli_affected_rows($link) > 0){
                return mysqli_insert_id($link);
            }
        }
    }
}
if(!function_exists('delete_post')){
    function delete_post($link, $post_id){
        $sql_delete = "DELETE FROM posts WHERE id = '$post_id';";
        if($query = mysqli_query($link,$sql_delete)){
            if(mysqli_affected_rows($link)>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
    }
}