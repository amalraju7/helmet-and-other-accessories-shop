<?php
class Db_object{
    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();
    public $image_placeholder = "https://via.placeholder.com/400";
    public $upload_errors_array = array(


        UPLOAD_ERR_OK           => "There is no error",
        UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
        UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
                                                    
    
    );

    public function image_path_and_placeholder(){
        
        return empty($this->filename) ? $this->image_placeholder : $this->upload_directory . DS . $this->filename;
    }

    public function delete_image_and_data(){
        if($this->delete())
        {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory .DS .$this->filename;
            return unlink($target_path) ? true : false; 
        }
        else
        {
            return false;
        }
    }

    public function delete_multiple_image_and_data(){
        if($this->delete())
        {
            $images = explode(" ",$this->images);
            foreach($images as $image){
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory .DS .$image;
            unlink($target_path); 
            }
        }
        else
        {
            return false;
        }
    }

    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded";
            return false; 
        }
        elseif($file['error']){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }
        else{
            $this->filename = $file['name'];
            $this->tmp_path = $file['tmp_name'];
           return true;

        }
    }

    public function picture_path(){
        return $this->upload_directory . DS . $this->filename;
    }

    public function save_multiple_images($files){
        
foreach($files['tmp_name'] as $key => $value ){
    $this->filename = $files['name'][$key];
  
    $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
    $this->images[] =$files['name'][$key];
    
    $this->tmp_path = $files['tmp_name'][$key];
    if(move_uploaded_file($this->tmp_path,$target_path));
    unset( $this->tmp_path);
   

    }
    $this->images = implode(" ",$this->images);
}


    public function save_data_and_image(){

        if($this->id){
            $this->update();
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->filename;
            move_uploaded_file($this->tmp_path , $target_path);
          
        }
        else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
                return false;
            }
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            if(move_uploaded_file($this->tmp_path , $target_path)){
             
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                  
                }

            }else{

                $this->error[] = "The file directory doesn't  have permission";
                return false;
            }
        }
    }



    private function has_the_attribute($attribute)
    {
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute , $object_vars);
    }

    public  static function find_by_id($id){

        $sql = "SELECT * FROM ".static::$db_table." WHERE id = ". $id . " LIMIT 1 ";

        $result = static::find_by_query($sql);

        return (!empty($result)) ? array_shift($result) : false ;  
    }

    public static function find_all()
    {
        $sql = "SELECT * FROM ".static::$db_table." ";

        return static::find_by_query($sql);
    }


    public static function find_by_query($sql){
        global $database;
        $result_set = $database->query($sql);

        $the_object_array = array();
        while($row = mysqli_fetch_assoc($result_set ))
        {
            $the_object_array[] = static::instantination($row);
        }
        return $the_object_array;
    }

    public static function instantination($row){
        $called_class = get_called_class();
        $new_object = new $called_class;
        foreach($row as $attribute => $value)
        {
            if($new_object->has_the_attribute($attribute)){
                $new_object->$attribute = $value;
            }

        }
        return $new_object;
    }

    public function properties(){
        $properties= array();
        foreach(static::$db_table_fields as $db_field)
        {
            if(property_exists($this ,$db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;

    }
 
    public function clean_properties(){
        global $database;
        $clean_properties = array();
        foreach($this->properties() as $key => $value)
        {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }
    
    public function create()
    {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO ". static::$db_table . "( ". implode(',' , array_keys($properties)) . " ) ";
        $sql .= "VALUES ( '" . implode("','",array_values($properties)) ."')";
        
        if($database->query($sql)){
            return true;
        }
        else{
            return false;
        }

    }

    public function update(){
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();
        foreach($properties as $key => $value)
        {
            $properties_pairs[] = "{$key} = '{$value}'";
        }
        $sql = "UPDATE ". static::$db_table . " SET " . implode("," , $properties_pairs);
        $sql .=  " WHERE id = ". $database->escape_string($this->id) ;

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }
        
    public function save(){
        return isset($this->id) ? $this->update() :  $this->create();
    }

    public function delete(){
        global $database;
    $sql = " DELETE FROM ". static::$db_table . " WHERE id = {$database->escape_string($this->id)} ";
   
    $database->query($sql);

    return (mysqli_affected_rows($database->connection) == 1)? true :false;

    }  

    public static function count_all(){

        global $database;
    $sql="SELECT COUNT(*) FROM " . static::$db_table;
    $result_set = $database->query($sql);
    $row = mysqli_fetch_array($result_set);
    return array_shift($row);
    }



    
}


?>