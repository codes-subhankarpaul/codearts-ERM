<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <?php
            if($_SESSION['emp_id'] == '')
            {
              echo "<script>location.href='".$baseURL."login.php';</script>";
            }
        ?>
        <title>Edit Profile - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <header class="custom-header">
            <!-- Dashboard Top Info Panel -->
            <?php include 'info_panel.php'; ?>
        </header>
        <main class="custom-dahboard-main">
            <div class="custom-page-wrap-dp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Dashboard Left Sidebar -->
                            <?php include 'dashboard.php'; ?>
                        </div>
                        <div class="col-lg-9">
                            <section class="inner-head-brd">
                                <h2>Employee Information Form</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li><a href="<?php echo $baseURL; ?>profile.php">Profile</a></li>
                                    <li><a href="<?php echo $baseURL; ?>edit_profile.php">Employee Personal Information Form</a></li>
                                    <li><a href="<?php echo $baseURL; ?>edit_profile_personal_info.php">Employee Personal Information Form</a></li>
                                    <li>Employee Personal Information Form</li>
                                </ul>
                            </section>
                             <section class="employee-form employee-basic-personal-bank-information">
        	                    <form method="POST" enctype="multipart/form-data" id="user-info-form">
                                        <h4>Personal Informations</h4>
                                        <?php
                                            $query = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                            $result = mysqli_query($con, $query);
                                            if($result->num_rows > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    ?>
                                                    <div class="form-group col-md-12">    
                                                        <label>Passport No</label>            
                                                        <input type="text" class="form-control"  placeholder="Passport Number" name="passport_no" value="<?php if($row['user_passport_number']!=''){echo $row['user_passport_number'];} ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Adhar No</label>            
                                                        <input type="text" class="form-control"  placeholder="Adhar Number" name="adhar_number" value="<?php if($row['user_adhar_number']!=''){echo $row['user_adhar_number'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Voter No</label>            
                                                        <input type="text" class="form-control"  placeholder="Voter Number" name="voter_id" value="<?php if($row['user_voter_id']!=''){echo $row['user_voter_id'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Pan No</label>            
                                                        <input type="text" class="form-control"  placeholder="Pan Number" name="pan_number" value="<?php if($row['user_pan_number']!=''){echo $row['user_pan_number'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Nationality</label> 
                                                        <select class="form-control" name="nationality" required>
                                                            <option value="">-- select one --</option>
                                                            <option value="afghan">Afghan</option>
                                                            <option value="albanian">Albanian</option>
                                                            <option value="algerian">Algerian</option>
                                                            <option value="american">American</option>
                                                            <option value="andorran">Andorran</option>
                                                            <option value="angolan">Angolan</option>
                                                            <option value="antiguans">Antiguans</option>
                                                            <option value="argentinean">Argentinean</option>
                                                            <option value="armenian">Armenian</option>
                                                            <option value="australian">Australian</option>
                                                            <option value="austrian">Austrian</option>
                                                            <option value="azerbaijani">Azerbaijani</option>
                                                            <option value="bahamian">Bahamian</option>
                                                            <option value="bahraini">Bahraini</option>
                                                            <option value="bangladeshi">Bangladeshi</option>
                                                            <option value="barbadian">Barbadian</option>
                                                            <option value="barbudans">Barbudans</option>
                                                            <option value="batswana">Batswana</option>
                                                            <option value="belarusian">Belarusian</option>
                                                            <option value="belgian">Belgian</option>
                                                            <option value="belizean">Belizean</option>
                                                            <option value="beninese">Beninese</option>
                                                            <option value="bhutanese">Bhutanese</option>
                                                            <option value="bolivian">Bolivian</option>
                                                            <option value="bosnian">Bosnian</option>
                                                            <option value="brazilian">Brazilian</option>
                                                            <option value="british">British</option>
                                                            <option value="bruneian">Bruneian</option>
                                                            <option value="bulgarian">Bulgarian</option>
                                                            <option value="burkinabe">Burkinabe</option>
                                                            <option value="burmese">Burmese</option>
                                                            <option value="burundian">Burundian</option>
                                                            <option value="cambodian">Cambodian</option>
                                                            <option value="cameroonian">Cameroonian</option>
                                                            <option value="canadian">Canadian</option>
                                                            <option value="cape verdean">Cape Verdean</option>
                                                            <option value="central african">Central African</option>
                                                            <option value="chadian">Chadian</option>
                                                            <option value="chilean">Chilean</option>
                                                            <option value="chinese">Chinese</option>
                                                            <option value="colombian">Colombian</option>
                                                            <option value="comoran">Comoran</option>
                                                            <option value="congolese">Congolese</option>
                                                            <option value="costa rican">Costa Rican</option>
                                                            <option value="croatian">Croatian</option>
                                                            <option value="cuban">Cuban</option>
                                                            <option value="cypriot">Cypriot</option>
                                                            <option value="czech">Czech</option>
                                                            <option value="danish">Danish</option>
                                                            <option value="djibouti">Djibouti</option>
                                                            <option value="dominican">Dominican</option>
                                                            <option value="dutch">Dutch</option>
                                                            <option value="east timorese">East Timorese</option>
                                                            <option value="ecuadorean">Ecuadorean</option>
                                                            <option value="egyptian">Egyptian</option>
                                                            <option value="emirian">Emirian</option>
                                                            <option value="equatorial guinean">Equatorial Guinean</option>
                                                            <option value="eritrean">Eritrean</option>
                                                            <option value="estonian">Estonian</option>
                                                            <option value="ethiopian">Ethiopian</option>
                                                            <option value="fijian">Fijian</option>
                                                            <option value="filipino">Filipino</option>
                                                            <option value="finnish">Finnish</option>
                                                            <option value="french">French</option>
                                                            <option value="gabonese">Gabonese</option>
                                                            <option value="gambian">Gambian</option>
                                                            <option value="georgian">Georgian</option>
                                                            <option value="german">German</option>
                                                            <option value="ghanaian">Ghanaian</option>
                                                            <option value="greek">Greek</option>
                                                            <option value="grenadian">Grenadian</option>
                                                            <option value="guatemalan">Guatemalan</option>
                                                            <option value="guinea-bissauan">Guinea-Bissauan</option>
                                                            <option value="guinean">Guinean</option>
                                                            <option value="guyanese">Guyanese</option>
                                                            <option value="haitian">Haitian</option>
                                                            <option value="herzegovinian">Herzegovinian</option>
                                                            <option value="honduran">Honduran</option>
                                                            <option value="hungarian">Hungarian</option>
                                                            <option value="icelander">Icelander</option>
                                                            <option value="indian" <?php if($row['user_nationality'] == 'indian') { echo 'selected'; } ?>>Indian</option>
                                                            <option value="indonesian">Indonesian</option>
                                                            <option value="iranian">Iranian</option>
                                                            <option value="iraqi">Iraqi</option>
                                                            <option value="irish">Irish</option>
                                                            <option value="israeli">Israeli</option>
                                                            <option value="italian">Italian</option>
                                                            <option value="ivorian">Ivorian</option>
                                                            <option value="jamaican">Jamaican</option>
                                                            <option value="japanese">Japanese</option>
                                                            <option value="jordanian">Jordanian</option>
                                                            <option value="kazakhstani">Kazakhstani</option>
                                                            <option value="kenyan">Kenyan</option>
                                                            <option value="kittian and nevisian">Kittian and Nevisian</option>
                                                            <option value="kuwaiti">Kuwaiti</option>
                                                            <option value="kyrgyz">Kyrgyz</option>
                                                            <option value="laotian">Laotian</option>
                                                            <option value="latvian">Latvian</option>
                                                            <option value="lebanese">Lebanese</option>
                                                            <option value="liberian">Liberian</option>
                                                            <option value="libyan">Libyan</option>
                                                            <option value="liechtensteiner">Liechtensteiner</option>
                                                            <option value="lithuanian">Lithuanian</option>
                                                            <option value="luxembourger">Luxembourger</option>
                                                            <option value="macedonian">Macedonian</option>
                                                            <option value="malagasy">Malagasy</option>
                                                            <option value="malawian">Malawian</option>
                                                            <option value="malaysian">Malaysian</option>
                                                            <option value="maldivan">Maldivan</option>
                                                            <option value="malian">Malian</option>
                                                            <option value="maltese">Maltese</option>
                                                            <option value="marshallese">Marshallese</option>
                                                            <option value="mauritanian">Mauritanian</option>
                                                            <option value="mauritian">Mauritian</option>
                                                            <option value="mexican">Mexican</option>
                                                            <option value="micronesian">Micronesian</option>
                                                            <option value="moldovan">Moldovan</option>
                                                            <option value="monacan">Monacan</option>
                                                            <option value="mongolian">Mongolian</option>
                                                            <option value="moroccan">Moroccan</option>
                                                            <option value="mosotho">Mosotho</option>
                                                            <option value="motswana">Motswana</option>
                                                            <option value="mozambican">Mozambican</option>
                                                            <option value="namibian">Namibian</option>
                                                            <option value="nauruan">Nauruan</option>
                                                            <option value="nepalese">Nepalese</option>
                                                            <option value="new zealander">New Zealander</option>
                                                            <option value="ni-vanuatu">Ni-Vanuatu</option>
                                                            <option value="nicaraguan">Nicaraguan</option>
                                                            <option value="nigerien">Nigerien</option>
                                                            <option value="north korean">North Korean</option>
                                                            <option value="northern irish">Northern Irish</option>
                                                            <option value="norwegian">Norwegian</option>
                                                            <option value="omani">Omani</option>
                                                            <option value="pakistani">Pakistani</option>
                                                            <option value="palauan">Palauan</option>
                                                            <option value="panamanian">Panamanian</option>
                                                            <option value="papua new guinean">Papua New Guinean</option>
                                                            <option value="paraguayan">Paraguayan</option>
                                                            <option value="peruvian">Peruvian</option>
                                                            <option value="polish">Polish</option>
                                                            <option value="portuguese">Portuguese</option>
                                                            <option value="qatari">Qatari</option>
                                                            <option value="romanian">Romanian</option>
                                                            <option value="russian">Russian</option>
                                                            <option value="rwandan">Rwandan</option>
                                                            <option value="saint lucian">Saint Lucian</option>
                                                            <option value="salvadoran">Salvadoran</option>
                                                            <option value="samoan">Samoan</option>
                                                            <option value="san marinese">San Marinese</option>
                                                            <option value="sao tomean">Sao Tomean</option>
                                                            <option value="saudi">Saudi</option>
                                                            <option value="scottish">Scottish</option>
                                                            <option value="senegalese">Senegalese</option>
                                                            <option value="serbian">Serbian</option>
                                                            <option value="seychellois">Seychellois</option>
                                                            <option value="sierra leonean">Sierra Leonean</option>
                                                            <option value="singaporean">Singaporean</option>
                                                            <option value="slovakian">Slovakian</option>
                                                            <option value="slovenian">Slovenian</option>
                                                            <option value="solomon islander">Solomon Islander</option>
                                                            <option value="somali">Somali</option>
                                                            <option value="south african">South African</option>
                                                            <option value="south korean">South Korean</option>
                                                            <option value="spanish">Spanish</option>
                                                            <option value="sri lankan">Sri Lankan</option>
                                                            <option value="sudanese">Sudanese</option>
                                                            <option value="surinamer">Surinamer</option>
                                                            <option value="swazi">Swazi</option>
                                                            <option value="swedish">Swedish</option>
                                                            <option value="swiss">Swiss</option>
                                                            <option value="syrian">Syrian</option>
                                                            <option value="taiwanese">Taiwanese</option>
                                                            <option value="tajik">Tajik</option>
                                                            <option value="tanzanian">Tanzanian</option>
                                                            <option value="thai">Thai</option>
                                                            <option value="togolese">Togolese</option>
                                                            <option value="tongan">Tongan</option>
                                                            <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                                            <option value="tunisian">Tunisian</option>
                                                            <option value="turkish">Turkish</option>
                                                            <option value="tuvaluan">Tuvaluan</option>
                                                            <option value="ugandan">Ugandan</option>
                                                            <option value="ukrainian">Ukrainian</option>
                                                            <option value="uruguayan">Uruguayan</option>
                                                            <option value="uzbekistani">Uzbekistani</option>
                                                            <option value="venezuelan">Venezuelan</option>
                                                            <option value="vietnamese">Vietnamese</option>
                                                            <option value="welsh">Welsh</option>
                                                            <option value="yemenite">Yemenite</option>
                                                            <option value="zambian">Zambian</option>
                                                            <option value="zimbabwean">Zimbabwean</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" placeholder="Your Nationality" name="nationality" value="<?php //if($row['user_nationality']!=''){echo $row['user_nationality'];} ?>" required> -->
                                                    </div>
                                                    <!-- <div class="form-group col-md-12">    
                                                        <label>Religion</label>            
                                                        <input type="text" class="form-control" placeholder="Your Religion" name="religion" value="<?php //if($row['user_religion']!=''){echo $row['user_religion'];} ?>" required>
                                                    </div> -->
                                                    <div class="form-group col-md-12">    
                                                        <label>Marital status</label>            
                                                        <select class="form-control" id="user_marital_status" name="user_marital_status">
                                                        <option>Choose Option</option>
                                                        <option value="Single" <?php if($row['user_marital_status'] == 'Single') { echo 'selected'; } ?>>Single</option>
                                                        <option value="Engaged" <?php if($row['user_marital_status'] == 'Engaged') { echo 'selected'; } ?>>Engaged</option>
                                                        <option value="Married" <?php if($row['user_marital_status'] == 'Married') { echo 'selected'; } ?>>Married</option>
                                                        <option value="Divorced" <?php if($row['user_marital_status'] == 'Divorced') { echo 'selected'; } ?>>Divorced</option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group col-md-12">    
                                                        <label>Employment of spouse</label>            
                                                        <select class="form-control" id="user_employment_of_spouse" name="user_employment_of_spouse">
                                                        <option>Choose Option</option>
                                                        <option value="Yes" <?php //if($row['user_employment_of_spouse'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php //if($row['user_employment_of_spouse'] == 'No') { echo 'selected'; } ?>>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>No. of children</label>            
                                                        <input type="text" class="form-control" placeholder="Number of children" name="number_of_children" value="<?php //if($row['user_children_number']!=''){echo $row['user_children_number'];} ?>">
                                                    </div> -->

                                                    <div class="col-md-12 text-center">
                                                        <button type="submit" name="user_personal_info_update" class="btn dp-em-nxt-btn">Next</button>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </form>
                                    <?php
                                        if(isset($_POST['user_personal_info_update']))
                                        {
                                            // $query = "UPDATE capms_admin_users SET user_passport_number = '".$_POST['passport_no']."' , user_adhar_number = '".$_POST['adhar_number']."', user_voter_id = '".$_POST['voter_id']."', user_pan_number = '".$_POST['pan_number']."', user_nationality = '".$_POST['nationality']."', user_religion = '".$_POST['religion']."', user_marital_status = '".$_POST['user_marital_status']."' , user_employment_of_spouse = '".$_POST['user_employment_of_spouse']."', user_children_number = '".$_POST['number_of_children']."' WHERE id = '".$_SESSION['emp_id']."' ";
                                            $query = "UPDATE capms_admin_users SET user_passport_number = '".$_POST['passport_no']."' , user_adhar_number = '".$_POST['adhar_number']."', user_voter_id = '".$_POST['voter_id']."', user_pan_number = '".$_POST['pan_number']."', user_nationality = '".$_POST['nationality']."', user_marital_status = '".$_POST['user_marital_status']."' , WHERE id = '".$_SESSION['emp_id']."' ";
                                            $result = mysqli_query($con,$query);
                                            echo "<script>location.href='".$baseURL."edit_profile_emargency_contact.php';</script>";
                                        } 
                                    ?>
                                </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="custom-footer">
            <!-- Copyright Content file -->
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
    </body>
</html>