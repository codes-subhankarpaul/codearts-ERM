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
                                                        <label>PF No</label>            
                                                        <input type="text" class="form-control"  placeholder="PF Number" name="pf_number" value="<?php if($row['user_pf_number']!=''){echo $row['user_pf_number'];} ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>ESI No</label>            
                                                        <input type="text" class="form-control"  placeholder="ESI Number" name="esi_number" value="<?php if($row['user_esi_number']!=''){echo $row['user_esi_number'];} ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>UAN No</label>            
                                                        <input type="text" class="form-control"  placeholder="UAN Number" name="uan_number" value="<?php if($row['user_uan_number']!=''){echo $row['user_uan_number'];} ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Nationality</label> 
                                                        <select class="form-control" name="nationality" required>
                                                            <option value="">-- select one --</option>
                                                            <option value="afghan" <?php if($row['user_nationality'] == 'afghan') { echo 'selected'; } ?>>Afghan</option>
                                                            <option value="albanian" <?php if($row['user_nationality'] == 'albanian') { echo 'selected'; } ?>>Albanian</option>
                                                            <option value="algerian" <?php if($row['user_nationality'] == 'algerian') { echo 'selected'; } ?>>Algerian</option>
                                                            <option value="american" <?php if($row['user_nationality'] == 'american') { echo 'selected'; } ?>>American</option>
                                                            <option value="andorran" <?php if($row['user_nationality'] == 'andorran') { echo 'selected'; } ?>>Andorran</option>
                                                            <option value="angolan" <?php if($row['user_nationality'] == 'angolan') { echo 'selected'; } ?>>Angolan</option>
                                                            <option value="antiguans" <?php if($row['user_nationality'] == 'antiguans') { echo 'selected'; } ?>>Antiguans</option>
                                                            <option value="argentinean" <?php if($row['user_nationality'] == 'argentinean') { echo 'selected'; } ?>>Argentinean</option>
                                                            <option value="armenian" <?php if($row['user_nationality'] == 'armenian') { echo 'selected'; } ?>>Armenian</option>
                                                            <option value="australian" <?php if($row['user_nationality'] == 'australian') { echo 'selected'; } ?>>Australian</option>
                                                            <option value="austrian" <?php if($row['user_nationality'] == 'austrian') { echo 'selected'; } ?>>Austrian</option>
                                                            <option value="azerbaijani" <?php if($row['user_nationality'] == 'azerbaijani') { echo 'selected'; } ?>>Azerbaijani</option>
                                                            <option value="bahamian" <?php if($row['user_nationality'] == 'bahamian') { echo 'selected'; } ?>>Bahamian</option>
                                                            <option value="bahraini" <?php if($row['user_nationality'] == 'bahraini') { echo 'selected'; } ?>>Bahraini</option>
                                                            <option value="bangladeshi" <?php if($row['user_nationality'] == 'bangladeshi') { echo 'selected'; } ?>>Bangladeshi</option>
                                                            <option value="barbadian" <?php if($row['user_nationality'] == 'barbadian') { echo 'selected'; } ?>>Barbadian</option>
                                                            <option value="barbudans" <?php if($row['user_nationality'] == 'barbudans') { echo 'selected'; } ?>>Barbudans</option>
                                                            <option value="batswana" <?php if($row['user_nationality'] == 'batswana') { echo 'selected'; } ?>>Batswana</option>
                                                            <option value="belarusian" <?php if($row['user_nationality'] == 'belarusian') { echo 'selected'; } ?>>Belarusian</option>
                                                            <option value="belgian" <?php if($row['user_nationality'] == 'belgian') { echo 'selected'; } ?>>Belgian</option>
                                                            <option value="belizean" <?php if($row['user_nationality'] == 'belizean') { echo 'selected'; } ?>>Belizean</option>
                                                            <option value="beninese" <?php if($row['user_nationality'] == 'beninese') { echo 'selected'; } ?>>Beninese</option>
                                                            <option value="bhutanese" <?php if($row['user_nationality'] == 'bhutanese') { echo 'selected'; } ?>>Bhutanese</option>
                                                            <option value="bolivian" <?php if($row['user_nationality'] == 'bolivian') { echo 'selected'; } ?>>Bolivian</option>
                                                            <option value="bosnian" <?php if($row['user_nationality'] == 'bosnian') { echo 'selected'; } ?>>Bosnian</option>
                                                            <option value="brazilian" <?php if($row['user_nationality'] == 'brazilian') { echo 'selected'; } ?>>Brazilian</option>
                                                            <option value="british" <?php if($row['user_nationality'] == 'british') { echo 'selected'; } ?>>British</option>
                                                            <option value="bruneian" <?php if($row['user_nationality'] == 'bruneian') { echo 'selected'; } ?>>Bruneian</option>
                                                            <option value="bulgarian" <?php if($row['user_nationality'] == 'bulgarian') { echo 'selected'; } ?>>Bulgarian</option>
                                                            <option value="burkinabe" <?php if($row['user_nationality'] == 'burkinabe') { echo 'selected'; } ?>>Burkinabe</option>
                                                            <option value="burmese" <?php if($row['user_nationality'] == 'burmese') { echo 'selected'; } ?>>Burmese</option>
                                                            <option value="burundian" <?php if($row['user_nationality'] == 'burundian') { echo 'selected'; } ?>>Burundian</option>
                                                            <option value="cambodian" <?php if($row['user_nationality'] == 'cambodian') { echo 'selected'; } ?>>Cambodian</option>
                                                            <option value="cameroonian" <?php if($row['user_nationality'] == 'cameroonian') { echo 'selected'; } ?>>Cameroonian</option>
                                                            <option value="canadian" <?php if($row['user_nationality'] == 'canadian') { echo 'selected'; } ?>>Canadian</option>
                                                            <option value="cape verdean" <?php if($row['user_nationality'] == 'cape verdean') { echo 'selected'; } ?>>Cape Verdean</option>
                                                            <option value="central african" <?php if($row['user_nationality'] == 'central african') { echo 'selected'; } ?>>Central African</option>
                                                            <option value="chadian" <?php if($row['user_nationality'] == 'chadian') { echo 'selected'; } ?>>Chadian</option>
                                                            <option value="chilean" <?php if($row['user_nationality'] == 'chilean') { echo 'selected'; } ?>>Chilean</option>
                                                            <option value="chinese" <?php if($row['user_nationality'] == 'chinese') { echo 'selected'; } ?>>Chinese</option>
                                                            <option value="colombian" <?php if($row['user_nationality'] == 'colombian') { echo 'selected'; } ?>>Colombian</option>
                                                            <option value="comoran" <?php if($row['user_nationality'] == 'comoran') { echo 'selected'; } ?>>Comoran</option>
                                                            <option value="congolese" <?php if($row['user_nationality'] == 'congolese') { echo 'selected'; } ?>>Congolese</option>
                                                            <option value="costa rican" <?php if($row['user_nationality'] == 'costa rican') { echo 'selected'; } ?>>Costa Rican</option>
                                                            <option value="croatian" <?php if($row['user_nationality'] == 'croatian') { echo 'selected'; } ?>>Croatian</option>
                                                            <option value="cuban" <?php if($row['user_nationality'] == 'cuban') { echo 'selected'; } ?>>Cuban</option>
                                                            <option value="cypriot" <?php if($row['user_nationality'] == 'cypriot') { echo 'selected'; } ?>>Cypriot</option>
                                                            <option value="czech" <?php if($row['user_nationality'] == 'czech') { echo 'selected'; } ?>>Czech</option>
                                                            <option value="danish" <?php if($row['user_nationality'] == 'danish') { echo 'selected'; } ?>>Danish</option>
                                                            <option value="djibouti" <?php if($row['user_nationality'] == 'djibouti') { echo 'selected'; } ?>>Djibouti</option>
                                                            <option value="dominican" <?php if($row['user_nationality'] == 'dominican') { echo 'selected'; } ?>>Dominican</option>
                                                            <option value="dutch" <?php if($row['user_nationality'] == 'dutch') { echo 'selected'; } ?>>Dutch</option>
                                                            <option value="east timorese" <?php if($row['user_nationality'] == 'east timorese') { echo 'selected'; } ?>>East Timorese</option>
                                                            <option value="ecuadorean" <?php if($row['user_nationality'] == 'ecuadorean') { echo 'selected'; } ?>>Ecuadorean</option>
                                                            <option value="egyptian" <?php if($row['user_nationality'] == 'egyptian') { echo 'selected'; } ?>>Egyptian</option>
                                                            <option value="emirian" <?php if($row['user_nationality'] == 'emirian') { echo 'selected'; } ?>>Emirian</option>
                                                            <option value="equatorial guinean" <?php if($row['user_nationality'] == 'equatorial guinean') { echo 'selected'; } ?>>Equatorial Guinean</option>
                                                            <option value="eritrean" <?php if($row['user_nationality'] == 'eritrean') { echo 'selected'; } ?>>Eritrean</option>
                                                            <option value="estonian" <?php if($row['user_nationality'] == 'estonian') { echo 'selected'; } ?>>Estonian</option>
                                                            <option value="ethiopian" <?php if($row['user_nationality'] == 'ethiopian') { echo 'selected'; } ?>>Ethiopian</option>
                                                            <option value="fijian" <?php if($row['user_nationality'] == 'fijian') { echo 'selected'; } ?>>Fijian</option>
                                                            <option value="filipino" <?php if($row['user_nationality'] == 'filipino') { echo 'selected'; } ?>>Filipino</option>
                                                            <option value="finnish" <?php if($row['user_nationality'] == 'finnish') { echo 'selected'; } ?>>Finnish</option>
                                                            <option value="french" <?php if($row['user_nationality'] == 'french') { echo 'selected'; } ?>>French</option>
                                                            <option value="gabonese" <?php if($row['user_nationality'] == 'gabonese') { echo 'selected'; } ?>>Gabonese</option>
                                                            <option value="gambian" <?php if($row['user_nationality'] == 'gambian') { echo 'selected'; } ?>>Gambian</option>
                                                            <option value="georgian" <?php if($row['user_nationality'] == 'georgian') { echo 'selected'; } ?>>Georgian</option>
                                                            <option value="german" <?php if($row['user_nationality'] == 'german') { echo 'selected'; } ?>>German</option>
                                                            <option value="ghanaian" <?php if($row['user_nationality'] == 'ghanaian') { echo 'selected'; } ?>>Ghanaian</option>
                                                            <option value="greek" <?php if($row['user_nationality'] == 'greek') { echo 'selected'; } ?>>Greek</option>
                                                            <option value="grenadian" <?php if($row['user_nationality'] == 'grenadian') { echo 'selected'; } ?>>Grenadian</option>
                                                            <option value="guatemalan" <?php if($row['user_nationality'] == 'guatemalan') { echo 'selected'; } ?>>Guatemalan</option>
                                                            <option value="guinea-bissauan" <?php if($row['user_nationality'] == 'guinea-bissauan') { echo 'selected'; } ?>>Guinea-Bissauan</option>
                                                            <option value="guinean" <?php if($row['user_nationality'] == 'guinean') { echo 'selected'; } ?>>Guinean</option>
                                                            <option value="guyanese" <?php if($row['user_nationality'] == 'guyanese') { echo 'selected'; } ?>>Guyanese</option>
                                                            <option value="haitian" <?php if($row['user_nationality'] == 'haitian') { echo 'selected'; } ?>>Haitian</option>
                                                            <option value="herzegovinian" <?php if($row['user_nationality'] == 'herzegovinian') { echo 'selected'; } ?>>Herzegovinian</option>
                                                            <option value="honduran" <?php if($row['user_nationality'] == 'honduran') { echo 'selected'; } ?>>Honduran</option>
                                                            <option value="hungarian" <?php if($row['user_nationality'] == 'hungarian') { echo 'selected'; } ?>>Hungarian</option>
                                                            <option value="icelander" <?php if($row['user_nationality'] == 'icelander') { echo 'selected'; } ?>>Icelander</option>
                                                            <option value="indian" <?php if($row['user_nationality'] == 'indian') { echo 'selected'; } ?>>Indian</option>
                                                            <option value="indonesian" <?php if($row['user_nationality'] == 'indonesian') { echo 'selected'; } ?>>Indonesian</option>
                                                            <option value="iranian" <?php if($row['user_nationality'] == 'iranian') { echo 'selected'; } ?>>Iranian</option>
                                                            <option value="iraqi" <?php if($row['user_nationality'] == 'iraqi') { echo 'selected'; } ?>>Iraqi</option>
                                                            <option value="irish" <?php if($row['user_nationality'] == 'irish') { echo 'selected'; } ?>>Irish</option>
                                                            <option value="israeli" <?php if($row['user_nationality'] == 'israeli') { echo 'selected'; } ?>>Israeli</option>
                                                            <option value="italian" <?php if($row['user_nationality'] == 'italian') { echo 'selected'; } ?>>Italian</option>
                                                            <option value="ivorian" <?php if($row['user_nationality'] == 'ivorian') { echo 'selected'; } ?>>Ivorian</option>
                                                            <option value="jamaican" <?php if($row['user_nationality'] == 'jamaican') { echo 'selected'; } ?>>Jamaican</option>
                                                            <option value="japanese" <?php if($row['user_nationality'] == 'japanese') { echo 'selected'; } ?>>Japanese</option>
                                                            <option value="jordanian" <?php if($row['user_nationality'] == 'jordanian') { echo 'selected'; } ?>>Jordanian</option>
                                                            <option value="kazakhstani" <?php if($row['user_nationality'] == 'kazakhstani') { echo 'selected'; } ?>>Kazakhstani</option>
                                                            <option value="kenyan" <?php if($row['user_nationality'] == 'kenyan') { echo 'selected'; } ?>>Kenyan</option>
                                                            <option value="kittian and nevisian" <?php if($row['user_nationality'] == 'kittian and nevisian') { echo 'selected'; } ?>>Kittian and Nevisian</option>
                                                            <option value="kuwaiti" <?php if($row['user_nationality'] == 'kuwaiti') { echo 'selected'; } ?>>Kuwaiti</option>
                                                            <option value="kyrgyz" <?php if($row['user_nationality'] == 'kyrgyz') { echo 'selected'; } ?>>Kyrgyz</option>
                                                            <option value="laotian" <?php if($row['user_nationality'] == 'laotian') { echo 'selected'; } ?>>Laotian</option>
                                                            <option value="latvian" <?php if($row['user_nationality'] == 'latvian') { echo 'selected'; } ?>>Latvian</option>
                                                            <option value="lebanese" <?php if($row['user_nationality'] == 'lebanese') { echo 'selected'; } ?>>Lebanese</option>
                                                            <option value="liberian" <?php if($row['user_nationality'] == 'liberian') { echo 'selected'; } ?>>Liberian</option>
                                                            <option value="libyan" <?php if($row['user_nationality'] == 'libyan') { echo 'selected'; } ?>>Libyan</option>
                                                            <option value="liechtensteiner" <?php if($row['user_nationality'] == 'liechtensteiner') { echo 'selected'; } ?>>Liechtensteiner</option>
                                                            <option value="lithuanian" <?php if($row['user_nationality'] == 'lithuanian') { echo 'selected'; } ?>>Lithuanian</option>
                                                            <option value="luxembourger" <?php if($row['user_nationality'] == 'luxembourger') { echo 'selected'; } ?>>Luxembourger</option>
                                                            <option value="macedonian" <?php if($row['user_nationality'] == 'macedonian') { echo 'selected'; } ?>>Macedonian</option>
                                                            <option value="malagasy" <?php if($row['user_nationality'] == 'malagasy') { echo 'selected'; } ?>>Malagasy</option>
                                                            <option value="malawian" <?php if($row['user_nationality'] == 'malawian') { echo 'selected'; } ?>>Malawian</option>
                                                            <option value="malaysian" <?php if($row['user_nationality'] == 'malaysian') { echo 'selected'; } ?>>Malaysian</option>
                                                            <option value="maldivan" <?php if($row['user_nationality'] == 'maldivan') { echo 'selected'; } ?>>Maldivan</option>
                                                            <option value="malian" <?php if($row['user_nationality'] == 'malian') { echo 'selected'; } ?>>Malian</option>
                                                            <option value="maltese" <?php if($row['user_nationality'] == 'maltese') { echo 'selected'; } ?>>Maltese</option>
                                                            <option value="marshallese" <?php if($row['user_nationality'] == 'marshallese') { echo 'selected'; } ?>>Marshallese</option>
                                                            <option value="mauritanian" <?php if($row['user_nationality'] == 'mauritanian') { echo 'selected'; } ?>>Mauritanian</option>
                                                            <option value="mauritian" <?php if($row['user_nationality'] == 'mauritian') { echo 'selected'; } ?>>Mauritian</option>
                                                            <option value="mexican" <?php if($row['user_nationality'] == 'mexican') { echo 'selected'; } ?>>Mexican</option>
                                                            <option value="micronesian" <?php if($row['user_nationality'] == 'micronesian') { echo 'selected'; } ?>>Micronesian</option>
                                                            <option value="moldovan" <?php if($row['user_nationality'] == 'moldovan') { echo 'selected'; } ?>>Moldovan</option>
                                                            <option value="monacan" <?php if($row['user_nationality'] == 'monacan') { echo 'selected'; } ?>>Monacan</option>
                                                            <option value="mongolian" <?php if($row['user_nationality'] == 'mongolian') { echo 'selected'; } ?>>Mongolian</option>
                                                            <option value="moroccan" <?php if($row['user_nationality'] == 'moroccan') { echo 'selected'; } ?>>Moroccan</option>
                                                            <option value="mosotho" <?php if($row['user_nationality'] == 'mosotho') { echo 'selected'; } ?>>Mosotho</option>
                                                            <option value="motswana" <?php if($row['user_nationality'] == 'motswana') { echo 'selected'; } ?>>Motswana</option>
                                                            <option value="mozambican" <?php if($row['user_nationality'] == 'mozambican') { echo 'selected'; } ?>>Mozambican</option>
                                                            <option value="namibian" <?php if($row['user_nationality'] == 'namibian') { echo 'selected'; } ?>>Namibian</option>
                                                            <option value="nauruan" <?php if($row['user_nationality'] == 'nauruan') { echo 'selected'; } ?>>Nauruan</option>
                                                            <option value="nepalese" <?php if($row['user_nationality'] == 'nepalese') { echo 'selected'; } ?>>Nepalese</option>
                                                            <option value="new zealander" <?php if($row['user_nationality'] == 'new zealander') { echo 'selected'; } ?>>New Zealander</option>
                                                            <option value="ni-vanuatu" <?php if($row['user_nationality'] == 'ni-vanuatu') { echo 'selected'; } ?>>Ni-Vanuatu</option>
                                                            <option value="nicaraguan" <?php if($row['user_nationality'] == 'nicaraguan') { echo 'selected'; } ?>>Nicaraguan</option>
                                                            <option value="nigerien" <?php if($row['user_nationality'] == 'nigerien') { echo 'selected'; } ?>>Nigerien</option>
                                                            <option value="north korean" <?php if($row['user_nationality'] == 'north korean') { echo 'selected'; } ?>>North Korean</option>
                                                            <option value="northern irish" <?php if($row['user_nationality'] == 'northern irish') { echo 'selected'; } ?>>Northern Irish</option>
                                                            <option value="norwegian" <?php if($row['user_nationality'] == 'norwegian') { echo 'selected'; } ?>>Norwegian</option>
                                                            <option value="omani" <?php if($row['user_nationality'] == 'omani') { echo 'selected'; } ?>>Omani</option>
                                                            <option value="pakistani" <?php if($row['user_nationality'] == 'pakistani') { echo 'selected'; } ?>>Pakistani</option>
                                                            <option value="palauan" <?php if($row['user_nationality'] == 'palauan') { echo 'selected'; } ?>>Palauan</option>
                                                            <option value="panamanian" <?php if($row['user_nationality'] == 'panamanian') { echo 'selected'; } ?>>Panamanian</option>
                                                            <option value="papua new guinean" <?php if($row['user_nationality'] == 'papua new guinean') { echo 'selected'; } ?>>Papua New Guinean</option>
                                                            <option value="paraguayan" <?php if($row['user_nationality'] == 'paraguayan') { echo 'selected'; } ?>>Paraguayan</option>
                                                            <option value="peruvian" <?php if($row['user_nationality'] == 'peruvian') { echo 'selected'; } ?>>Peruvian</option>
                                                            <option value="polish" <?php if($row['user_nationality'] == 'polish') { echo 'selected'; } ?>>Polish</option>
                                                            <option value="portuguese" <?php if($row['user_nationality'] == 'portuguese') { echo 'selected'; } ?>>Portuguese</option>
                                                            <option value="qatari" <?php if($row['user_nationality'] == 'qatari') { echo 'selected'; } ?>>Qatari</option>
                                                            <option value="romanian" <?php if($row['user_nationality'] == 'romanian') { echo 'selected'; } ?>>Romanian</option>
                                                            <option value="russian" <?php if($row['user_nationality'] == 'russian') { echo 'selected'; } ?>>Russian</option>
                                                            <option value="rwandan" <?php if($row['user_nationality'] == 'rwandan') { echo 'selected'; } ?>>Rwandan</option>
                                                            <option value="saint lucian" <?php if($row['user_nationality'] == 'saint lucian') { echo 'selected'; } ?>>Saint Lucian</option>
                                                            <option value="salvadoran" <?php if($row['user_nationality'] == 'salvadoran') { echo 'selected'; } ?>>Salvadoran</option>
                                                            <option value="samoan" <?php if($row['user_nationality'] == 'samoan') { echo 'selected'; } ?>>Samoan</option>
                                                            <option value="san marinese" <?php if($row['user_nationality'] == 'san marinese') { echo 'selected'; } ?>>San Marinese</option>
                                                            <option value="sao tomean" <?php if($row['user_nationality'] == 'sao tomean') { echo 'selected'; } ?>>Sao Tomean</option>
                                                            <option value="saudi" <?php if($row['user_nationality'] == 'saudi') { echo 'selected'; } ?>>Saudi</option>
                                                            <option value="scottish" <?php if($row['user_nationality'] == 'scottish') { echo 'selected'; } ?>>Scottish</option>
                                                            <option value="senegalese" <?php if($row['user_nationality'] == 'senegalese') { echo 'selected'; } ?>>Senegalese</option>
                                                            <option value="serbian" <?php if($row['user_nationality'] == 'serbian') { echo 'selected'; } ?>>Serbian</option>
                                                            <option value="seychellois" <?php if($row['user_nationality'] == 'seychellois') { echo 'selected'; } ?>>Seychellois</option>
                                                            <option value="sierra leonean" <?php if($row['user_nationality'] == 'sierra leonean') { echo 'selected'; } ?>>Sierra Leonean</option>
                                                            <option value="singaporean" <?php if($row['user_nationality'] == 'singaporean') { echo 'selected'; } ?>>Singaporean</option>
                                                            <option value="slovakian" <?php if($row['user_nationality'] == 'slovakian') { echo 'selected'; } ?>>Slovakian</option>
                                                            <option value="slovenian" <?php if($row['user_nationality'] == 'slovenian') { echo 'selected'; } ?>>Slovenian</option>
                                                            <option value="solomon islander" <?php if($row['user_nationality'] == 'solomon islander') { echo 'selected'; } ?>>Solomon Islander</option>
                                                            <option value="somali" <?php if($row['user_nationality'] == 'somali') { echo 'selected'; } ?>>Somali</option>
                                                            <option value="south african" <?php if($row['user_nationality'] == 'south african') { echo 'selected'; } ?>>South African</option>
                                                            <option value="south korean" <?php if($row['user_nationality'] == 'south korean') { echo 'selected'; } ?>>South Korean</option>
                                                            <option value="spanish" <?php if($row['user_nationality'] == 'spanish') { echo 'selected'; } ?>>Spanish</option>
                                                            <option value="sri lankan" <?php if($row['user_nationality'] == 'sri lankan') { echo 'selected'; } ?>>Sri Lankan</option>
                                                            <option value="sudanese" <?php if($row['user_nationality'] == 'sudanese') { echo 'selected'; } ?>>Sudanese</option>
                                                            <option value="surinamer" <?php if($row['user_nationality'] == 'surinamer') { echo 'selected'; } ?>>Surinamer</option>
                                                            <option value="swazi" <?php if($row['user_nationality'] == 'swazi') { echo 'selected'; } ?>>Swazi</option>
                                                            <option value="swedish" <?php if($row['user_nationality'] == 'swedish') { echo 'selected'; } ?>>Swedish</option>
                                                            <option value="swiss" <?php if($row['user_nationality'] == 'swiss') { echo 'selected'; } ?>>Swiss</option>
                                                            <option value="syrian" <?php if($row['user_nationality'] == 'syrian') { echo 'selected'; } ?>>Syrian</option>
                                                            <option value="taiwanese" <?php if($row['user_nationality'] == 'taiwanese') { echo 'selected'; } ?>>Taiwanese</option>
                                                            <option value="tajik" <?php if($row['user_nationality'] == 'tajik') { echo 'selected'; } ?>>Tajik</option>
                                                            <option value="tanzanian" <?php if($row['user_nationality'] == 'tanzanian') { echo 'selected'; } ?>>Tanzanian</option>
                                                            <option value="thai" <?php if($row['user_nationality'] == 'thai') { echo 'selected'; } ?>>Thai</option>
                                                            <option value="togolese" <?php if($row['user_nationality'] == 'togolese') { echo 'selected'; } ?>>Togolese</option>
                                                            <option value="tongan" <?php if($row['user_nationality'] == 'tongan') { echo 'selected'; } ?>>Tongan</option>
                                                            <option value="trinidadian or tobagonian" <?php if($row['user_nationality'] == 'trinidadian or tobagonian') { echo 'selected'; } ?>>Trinidadian or Tobagonian</option>
                                                            <option value="tunisian" <?php if($row['user_nationality'] == 'tunisian') { echo 'selected'; } ?>>Tunisian</option>
                                                            <option value="turkish" <?php if($row['user_nationality'] == 'turkish') { echo 'selected'; } ?>>Turkish</option>
                                                            <option value="tuvaluan" <?php if($row['user_nationality'] == 'tuvaluan') { echo 'selected'; } ?>>Tuvaluan</option>
                                                            <option value="ugandan" <?php if($row['user_nationality'] == 'ugandan') { echo 'selected'; } ?>>Ugandan</option>
                                                            <option value="ukrainian" <?php if($row['user_nationality'] == 'ukrainian') { echo 'selected'; } ?>>Ukrainian</option>
                                                            <option value="uruguayan" <?php if($row['user_nationality'] == 'uruguayan') { echo 'selected'; } ?>>Uruguayan</option>
                                                            <option value="uzbekistani" <?php if($row['user_nationality'] == 'uzbekistani') { echo 'selected'; } ?>>Uzbekistani</option>
                                                            <option value="venezuelan" <?php if($row['user_nationality'] == 'venezuelan') { echo 'selected'; } ?>>Venezuelan</option>
                                                            <option value="vietnamese" <?php if($row['user_nationality'] == 'vietnamese') { echo 'selected'; } ?>>Vietnamese</option>
                                                            <option value="welsh" <?php if($row['user_nationality'] == 'welsh') { echo 'selected'; } ?>>Welsh</option>
                                                            <option value="yemenite" <?php if($row['user_nationality'] == 'yemenite') { echo 'selected'; } ?>>Yemenite</option>
                                                            <option value="zambian" <?php if($row['user_nationality'] == 'zambian') { echo 'selected'; } ?>>Zambian</option>
                                                            <option value="zimbabwean" <?php if($row['user_nationality'] == 'zimbabwean') { echo 'selected'; } ?>>Zimbabwean</option>
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
                                                        <a href="edit_profile_basic_info.php" class="btn dp-em-nxt-btn frm-previous-btn">Previous</a>
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
                                            $query = "UPDATE capms_admin_users SET user_passport_number = '".$_POST['passport_no']."' , user_adhar_number = '".$_POST['adhar_number']."', user_voter_id = '".$_POST['voter_id']."', user_pan_number = '".$_POST['pan_number']."',`user_pf_number`='".$_POST['pf_number']."',`user_esi_number`='".$_POST['esi_number']."',`user_uan_number`='".$_POST['uan_number']."', user_nationality = '".$_POST['nationality']."', user_marital_status = '".$_POST['user_marital_status']."' , WHERE id = '".$_SESSION['emp_id']."' ";
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