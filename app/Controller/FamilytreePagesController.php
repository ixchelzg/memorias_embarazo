<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'facebook');

/**
 * FamilytreePages Controller
 *
 */
class FamilytreePagesController extends AppController {
	var $uses = array('FamilytreePage','Profile');
/**
 * Scaffold
 *
 * @var mixed
 */
//public $scaffold; 
public function beforeFilter() {

		$this->Session->write("facebook", 
			new Facebook(array(
        'appId' => "163480813810636",
        'secret' => "3ccf0a83049aa75bd8f0bc9707b9e7a0",
        'cookie' => true
      ))
    );
	
	}
	
	public function add(){
		$facebook = $this->Session->read("facebook");
		$uid  = $facebook->getUser();

		 if( $this->Session->read('User.uid') ){
      	$id = $this->Profile->find('first', array( 'conditions' => array( 'Profile.uid' =>  $this->Session->read('User.uid') ) ) );
      } else {
      	$id = $this->Profile->find('first', array( 'conditions' => array( 'Profile.uid' => $uid ) ) );
      }

      $leid = $id['Profile']['id'];
      
      //got users id, return fields if they full, also, check if post or put and save
      if ($this->request->is('post') || $this->request->is('put')) {

        $idf = $this->FamilytreePage->find('first', array( 'conditions' => array( 'FamilytreePage.profile_id' =>  $leid ) ) );
        
        if( !empty($idf['FamilytreePage']['id']) && !is_null($idf['FamilytreePage']['id'])){
          $this->FamilytreePage->id = $idf['FamilytreePage']['id'];
        }

        $this->FamilytreePage->set(array( 
            'mom' => $this->request->data['FamilytreePage']['mom'],
            'dad' => $this->request->data['FamilytreePage']['dad'],
            'grandpa_mom' => $this->request->data['FamilytreePage']['grandpa_mom'],
            'grandpa_dad' => $this->request->data['FamilytreePage']['grandpa_dad'],
            'grandma_mom' => $this->request->data['FamilytreePage']['grandma_mom'],
            'grandma_dad' => $this->request->data['FamilytreePage']['grandma_dad'],
            'baby' => $this->request->data['FamilytreePage']['baby'],
            'profile_id' => $this->request->data['FamilytreePage']['profile_id']
          ));

        if(!empty($this->request->data['FamilytreePage']['grandma_dad_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_grandmadad_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['grandma_dad_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'grandma_dad_img' => $fileName
            ));
            
              if ($this->FamilytreePage->save()) {
                //$this->Session->setFlash(__('The Cover photo has been saved'));
              } else {
                $this->Session->setFlash(__('The image photo could not be saved. Please, try again.'));
              }
          }

        } elseif (!empty($this->request->data['FamilytreePage']['grandma_dad_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['grandma_dad_url']['url_photo']);
          $nameIMG = 'grandma_dad_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'grandma_dad_img' => $nameIMG
          ));
          
        }

        if(!empty($this->request->data['FamilytreePage']['grandma_mom_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_grandmamom_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['grandma_mom_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'grandma_mom_img' => $fileName
            ));
            
              if ($this->FamilytreePage->save()) {
                //$this->Session->setFlash(__('The Cover photo has been saved'));
              } else {
                $this->Session->setFlash(__('The image photo could not be saved. Please, try again.'));
              }
          }

        } elseif (!empty($this->request->data['FamilytreePage']['grandma_mom_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['grandma_mom_url']['url_photo']);
          $nameIMG = 'grandma_mom_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'grandma_mom_img' => $nameIMG
          ));
          
        }

        if(!empty($this->request->data['FamilytreePage']['grandpa_dad_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_gradpadad_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['grandpa_dad_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'grandpa_dad_img' => $fileName
            ));
            
              if ($this->FamilytreePage->save()) {
                //$this->Session->setFlash(__('The Cover photo has been saved'));
              } else {
                $this->Session->setFlash(__('The image photo could not be saved. Please, try again.'));
              }
          }

        } elseif (!empty($this->request->data['FamilytreePage']['grandpa_dad_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['grandpa_dad_url']['url_photo']);
          $nameIMG = 'grandpa_dad_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'grandpa_dad_img' => $nameIMG
          ));
          
        }

        if(!empty($this->request->data['FamilytreePage']['grandpa_mom_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_mom_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['grandpa_mom_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'grandpa_mom_img' => $fileName
            ));
            
              if ($this->FamilytreePage->save()) {
                //$this->Session->setFlash(__('The Cover photo has been saved'));
              } else {
                $this->Session->setFlash(__('The image photo could not be saved. Please, try again.'));
              }
          }

        } elseif (!empty($this->request->data['FamilytreePage']['grandpa_mom_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['grandpa_mom_url']['url_photo']);
          $nameIMG = 'grandpa_mom_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'grandpa_mom_img' => $nameIMG
          ));
          
        }

        if(!empty($this->request->data['FamilytreePage']['dad_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_dad_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['dad_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'dad_img' => $fileName
            ));
            
              if ($this->FamilytreePage->save()) {
                //$this->Session->setFlash(__('The Cover photo has been saved'));
              } else {
                $this->Session->setFlash(__('The image photo could not be saved. Please, try again.'));
              }
          }

        } elseif (!empty($this->request->data['FamilytreePage']['dad_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['dad_url']['url_photo']);
          $nameIMG = 'dad_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'dad_img' => $nameIMG
          ));
          
        }


        if(!empty($this->request->data['FamilytreePage']['mom_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_mom_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['mom_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'mom_img' => $fileName
            ));
            
              if ($this->FamilytreePage->save()) {
                //$this->Session->setFlash(__('The Cover photo has been saved'));
              } else {
                $this->Session->setFlash(__('The image photo could not be saved. Please, try again.'));
              }
          }

        } elseif (!empty($this->request->data['FamilytreePage']['mom_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['mom_url']['url_photo']);
          $nameIMG = 'mom_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'mom_img' => $nameIMG
          ));
          
        }

        if(!empty($this->request->data['FamilytreePage']['baby_img']['tmp_name']) ) { 

        $fileName = $this->generateUniqueFilename('familytree_bby_'.$id['Profile']['uid'].'.png'); 
        $error = $this->handleFileUpload($this->request->data['FamilytreePage']['baby_img'], $fileName); 

          if ($error == false) { 
            $this->generate_image_thumbnail(WWW_ROOT.'img/cover_photos/'.$fileName,WWW_ROOT.'img/cover_photos/'.$fileName);
            
            $this->FamilytreePage->set(array( 
              'baby_img' => $fileName
            ));
            
          }

        } elseif (!empty($this->request->data['FamilytreePage']['baby_url']['url_photo'])) {

          $avatar = imagecreatefromjpeg($this->request->data['FamilytreePage']['baby_url']['url_photo']);
          $nameIMG = 'baby_'.$uid.'.png';
          imagepng($avatar, WWW_ROOT.'img/cover_photos/'.$nameIMG); 

          $this->FamilytreePage->set(array( 
            'baby_img' => $nameIMG
          ));
          
        }



        if ($this->FamilytreePage->save()) {
          //$this->Session->setFlash(__('The Cover photo has been saved'));
        } else {
          $this->Session->setFlash(__('The Page could not be saved. Please, try again.'));
        }


      }

       $this->set('familytree',$this->FamilytreePage->find('first', array( 'conditions' => array( 'FamilytreePage.profile_id' => $leid ) )));
		   $this->set('profileid',$leid);


	}


  
  /**
   * resample method
   *
   * @return new file name
   */

  protected function resample($jpgFile, $orientation, $nameIMG) { //$thumbFile, $width
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($jpgFile['tmp_name']);

    //$height = (int) (($width / $width_orig) * $height_orig);
    // Resample
    $image_p = imagecreatetruecolor($width_orig, $height_orig);
    $image   = imagecreatefromjpeg($jpgFile['tmp_name']);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width_orig, $height_orig, $width_orig, $height_orig);


    // Fix Orientation
    switch($orientation) {
        case 3:
            $image_p = imagerotate($image_p, 180, 0);
            break;
        case 6:
            $image_p = imagerotate($image_p, -90, 0);
            break;
        case 8:
            $image_p = imagerotate($image_p, 90, 0);
            break;
    }
    // Output
    imagejpeg($image_p, WWW_ROOT.'img/cover_photos/'.$nameIMG);
  }



 /**
   * generateUniqueFilename method
   *
   * @return new file name
   */

  protected function generateUniqueFilename($fileName, $path=''){ 
    $path = empty($path) ? WWW_ROOT.'img/cover_photos/' : $path; 
    $no = 1; 
    $newFileName = $fileName; 
    while (file_exists("$path/".$newFileName)) { 
      $no++; 
      $newFileName = substr_replace($fileName, "_$no.", strrpos($fileName, "."), 1); 
    } 
    return $newFileName; 
  } 

  /**
   * handleFileUpload method
   *
   * @return BOOL
   */
  function handleFileUpload($fileData, $fileName){
    $image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','tiff', 'bmp', 'ttf', 'otf');  
    $error = true; 

    //Get file type 
    $typeArr = explode('/', $fileData['type']); 
    
    $ext = strtolower(substr(strrchr($fileName, "."), 1));
    

    //If size is provided for validation check with that size. Else compare the size with INI file 
    if (($this->validateFile['size'] && $fileData['size'] > $this->validateFile['size']) || $fileData['error'] == UPLOAD_ERR_INI_SIZE) 
    { 
      $error = 'File is too large to upload'; 
    } elseif(!in_array($ext, $image_extensions_allowed)){

        $exts = implode(', ',$image_extensions_allowed);
        $error = ' ojo: '.$ext.' = '.$fileName." You must upload a file with one of the following extensions: ".$exts;
      } elseif ($this->validateFile['type'] && (strpos($this->validateFile['type'], strtolower($typeArr[1])) === false)) { 
      //File type is not the one we are going to accept. Error!! 
      $error = 'Invalid file type'; 
    } else { 
      //Data looks OK at this stage. Let's proceed.
      $exif = exif_read_data($fileData['tmp_name']);
        $ort = $exif['Orientation'];
        $ext1 = $fileData['type'];
    
        $image_extensions_allowed_1 = array('image/jpeg', 'image/jpg', 'image/tiff');  

        if(in_array($ext1, $image_extensions_allowed_1)){        
          
          $this->resample($fileData,$ort,$fileName);
          $error = false;

        } else {

          if ($fileData['error'] == UPLOAD_ERR_OK) { 
        //Oops!! File size is zero. Error! 
            if ($fileData['size'] == 0) { 
                $error = 'Zero size file found.'; 
            } else { 
                if (is_uploaded_file($fileData['tmp_name'])) 
                { 
                    //Finally we can upload file now. Let's do it and return without errors if success in moving. 
                    if (move_uploaded_file($fileData['tmp_name'], WWW_ROOT.'img/cover_photos/'.$fileName) == true) 
                    { 
                        $error = false; 
                    } else {
                      $error = true; 
                    }
                } else { 
                    return true; 
                } 
            } 
        } 
      }
    } 
    return $error; 
  }

  /**
   * deleteMovedFile method
   *
   * @return BOOL
   */
  function deleteMovedFile($fileName) 
  { 
    if (!$fileName || !is_file($fileName)){ 
      return true; 
    } 
    if(unlink($fileName)) { 
      return true; 
    } 
    return false; 
  } 

  /*
   * PHP function to resize an image maintaining aspect ratio
   * http://salman-w.blogspot.com/2008/10/resize-images-using-phpgd-library.html
   *
   * Creates a resized (e.g. thumbnail, small, medium, large)
   * version of an image file and saves it as another file
   */
  public function generate_image_thumbnail($source_image_path, $thumbnail_image_path)
  {
    $THUMBNAIL_IMAGE_MAX_WIDTH = 170;

    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
      case IMAGETYPE_GIF:
          $source_gd_image = imagecreatefromgif($source_image_path);
          break;
      case IMAGETYPE_JPEG:
          $source_gd_image = imagecreatefromjpeg($source_image_path);
          break;
      case IMAGETYPE_PNG:
          $source_gd_image = imagecreatefrompng($source_image_path);
          break;
    }
    if ($source_gd_image === false) {
      return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;

    if ($source_image_width <= $THUMBNAIL_IMAGE_MAX_WIDTH) {
      $thumbnail_image_width = $source_image_width;
      $thumbnail_image_height = $source_image_height;
    } else {
      $thumbnail_image_width = $THUMBNAIL_IMAGE_MAX_WIDTH;
      $thumbnail_image_height = (int) ($THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
    }

    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
  }





}
