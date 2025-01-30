<?php 
include("../include/function.php");
error_reporting(0);
 
     if(($_SESSION['filter_status']!='') && ($_SESSION['filter_sdate1']=='') && ($_SESSION['filter_sdate2']=='')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
     $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `status`='".$_SESSION['filter_status']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
 while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
     header("content-type:application/csv;charset=UTF-8");
    #header('Content-Type: text/csv charset=UTF-8'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

  elseif(($_SESSION['filter_status']=='') && ($_SESSION['filter_sdate1']!='') && ($_SESSION['filter_sdate2']!='')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status');
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `record_date` BETWEEN '".$_SESSION['filter_sdate1']."' AND '".$_SESSION['filter_sdate2']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 
    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

  elseif(($_SESSION['filter_rfilter']=='All')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
     $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status');
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl`  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
  while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    }  

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

 elseif(($_SESSION['filter_rfilter']==date('M-Y'))){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status');  
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `up_month`='".$_SESSION['filter_rfilter']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

elseif(($_SESSION['filter_rfilter']=='6months')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
     $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
   while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 
    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

elseif(($_SESSION['filter_rfilter']=='1year')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
  while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}



 elseif(($_SESSION['filter_status']!='') && ($_SESSION['filter_rfilter']==date('M-Y'))){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
   $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `up_month`='".$_SESSION['filter_rfilter']."' AND status ='".$_SESSION['filter_status']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
  while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

elseif(($_SESSION['filter_status']!='') && ($_SESSION['filter_rfilter']=='6months')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH AND status ='".$_SESSION['filter_status']."' ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
 while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

elseif(($_SESSION['filter_status']!='') && ($_SESSION['filter_rfilter']=='1year')){

$delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR AND status ='".$_SESSION['filter_status']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
  while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}



else{

      $delimiter = ","; 
       $filename = "user-registration-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    #$fields = array('Product Name', 'Gtins Name' , 'Company Name', 'Company Name Arabic', 'Address', 'Arabic Address', 'Country', 'City', 'Fax Number', 'Zip Code', 'Cr Number', 'Mobile Number','Email','Registration Fee','Gtins Annual Fee','Gln Price' ,'Annual Subscription Fee','Annual Total Price'); 

   $fields = array('Company Name English', 'City' , 'Company Name Arabic', 'Country', 'PO Box', 'Mobile Number', 'Zip/Postal Code', 'Phone Number', 'Address English', 'Fax Number', 'Address Arabic', 'Website Address','Company Registration No','User Name','Legal Type','CR Registration Date' ,'Main Product Category','CR Expiry Date','text of Employees','Tax Registration text','1 Person Title *','1 Person First Name','1 Person Last Name','1 Person Job Title','1 Person Email Id','1 Person Phone Number','1 Person Main Contact?','2nd Person Title *','2nd Person First Name','2nd Person Last Name','2nd Person Job Title','2nd Person Email Id','2nd Person Phone Number','2nd Person Main Contact?','Status');  


    fputcsv($f, $fields, $delimiter);


$query = "SELECT * FROM `company_tbl`  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 

        if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
             $query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);

            if($row['main_contact_status']=='Yes'){
                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'Yes',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'No',$show_status);
            }

              else{

                $lineData = array($row['name'], $row['city'], $row['name_ar'], $row['country'], $row['pobox'], $row['mobile_number'], $row['zipcode'], $row['phone_number'],$row['address'],$row['fax_number'],$row['address_ar'],$row['website_address'],$row['cr_number'],$row['user_email'],$row['cr_legal_type'],$row['cr_registration_date'],$row['business_type_product_category'],$row['cr_expiry_date'],$row['number_of_employee'],$row['cr_tax_registration_number'],$fetch1['title'],$fetch1['first_name'],$fetch1['last_name'],$fetch1['job_title'],$fetch1['email_id'],$fetch1['phone_number1'],'No',$fetch2['title'],$fetch2['first_name'],$fetch2['last_name'],$fetch2['job_title'],$fetch2['email_id'],$fetch2['phone_number1'],'Yes',$show_status);
            }

         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f);

}



        




?>