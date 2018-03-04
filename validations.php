<?php
    Class Validation {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function showError($err) {
          echo '<script> 
            var errDiv = document.createElement("div");
            errDiv.className = "error displaydiv";
            errDiv.innerHTML = ("'.$err.'");
            var formDiv = document.querySelector("form");
            formDiv.appendChild(errDiv);
          </script>';
        }

        function uploadError($error) { 
            switch ($error) { 
                case UPLOAD_ERR_INI_SIZE: 
                    $message = "The uploaded file is too large."; 
                    break; 
                case UPLOAD_ERR_FORM_SIZE: 
                    $message = "The uploaded file is too large."; 
                    break; 
                case UPLOAD_ERR_PARTIAL: 
                    $message = "The uploaded file was only partially uploaded."; 
                    break; 
                case UPLOAD_ERR_NO_FILE: 
                    $message = "No file was uploaded."; 
                    break; 
                case UPLOAD_ERR_NO_TMP_DIR: 
                    $message = "Missing a temporary folder."; 
                    break; 
                case UPLOAD_ERR_CANT_WRITE: 
                    $message = "Failed to write file to disk."; 
                    break; 
                case UPLOAD_ERR_EXTENSION: 
                    $message = "File upload stopped by extension."; 
                    break; 

                default: 
                    $message = "Unknown upload error"; 
                    break; 
            } 
            return $message; 
    } 

        function noError($msg) {
            echo '<script> 
                        var notifDiv = document.createElement("div");
                        notifDiv.className = "notification displaydiv";
                        notifDiv.innerHTML = ("'.$msg.'");
                        var formDiv = document.querySelector("form");
                        formDiv.appendChild(notifDiv);
                    </script>';
        }
    }    
?>