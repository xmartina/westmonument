<?php
include_once("./layout/header.php");

if (isset($_POST['register'])){
    $firstname = inputValidation($_POST['firstname']);
    $acct_username = uniqid();
    $lastname = inputValidation($_POST['lastname']);
    $acct_limit = inputValidation($_POST['acct_limit']);
    $limit_remain = inputValidation($_POST['limit_remain']);
    $acct_no = "9909".(substr(number_format(time() * rand(), 0, '', ''), 0, 6));
    // $acct_no =inputValidation($_POST['acct_no']);
    $ssn =inputValidation($_POST['ssn']);
    $acct_balance =inputValidation($_POST['acct_balance']);
    $avail_balance =inputValidation($_POST['avail_balance']);
    $acct_type = inputValidation($_POST['acct_type']);
    $acct_gender =inputValidation($_POST['acct_gender']);
    $marital_status = inputValidation($_POST['marital_status']);
    $acct_currency =inputValidation($_POST['acct_currency']);
    $acct_email = inputValidation($_POST['acct_email']);
    $acct_phone = inputValidation($_POST['acct_phone']);
    $acct_occupation = inputValidation($_POST['acct_occupation']);
    $acct_dob = inputValidation($_POST['acct_dob']);
    $country = inputValidation($_POST['country']);
    $state = inputValidation($_POST['state']);
    $acct_address =inputValidation($_POST['acct_address']);
    $acct_password =inputValidation( $_POST['acct_password']);
    $confirm_password = inputValidation($_POST['confirm_password']);
    $acct_cot = inputValidation($_POST['acct_cot']);
    $acct_imf = inputValidation($_POST['acct_imf']);
    $acct_tax = inputValidation($_POST['acct_tax']);
    $acct_pin = inputValidation($_POST['acct_pin']);
    // Account Manager Field
    $mgr_name = inputValidation($_POST['mgr_name']);
    $mgr_no = inputValidation($_POST['mgr_no']);
    $mgr_email = inputValidation($_POST['mgr_email']);
    $mgr_id = inputValidation($_POST['mgr_id']);
    $mgr_image = inputValidation($_POST['mgr_image']);
    
    


    if($acct_password !== $confirm_password){
        toast_alert('error','Password not matched');

    }else{
        //checking exiting email
        $usersVerified = "SELECT * FROM users WHERE acct_email=:acct_email";
        $stmt = $conn->prepare($usersVerified);
        $stmt->execute([
            'acct_email'=>$acct_email
        ]);

        if($stmt->rowCount() >0){
            toast_alert('error','Email Already Exit');
        }else{
            //INSERT INTO DATABASE
            $registered = "INSERT INTO users (acct_username,firstname,lastname,acct_limit,limit_remain,acct_email,acct_password,acct_no,ssn,acct_balance,avail_balance,acct_type,acct_gender,marital_status,acct_currency,acct_phone,acct_occupation,country,state,acct_address,acct_dob,acct_cot,acct_imf,acct_pin,acct_tax,mgr_name,mgr_no,mgr_email,mgr_id,mgr_image) VALUES(:acct_username,:firstname,:lastname,:acct_limit,:limit_remain,:acct_email,:acct_password,:acct_no,:ssn,:acct_balance,:avail_balance,:acct_type,:acct_gender,:marital_status,:acct_currency,:acct_phone,:acct_occupation,:country,:state,:acct_address,:acct_dob,:acct_cot,:acct_imf,:acct_tax,:acct_pin,:mgr_name,:mgr_no,:mgr_email,:mgr_id,:mgr_image)";
            $reg = $conn->prepare($registered);
            $reg->execute([
                'acct_username' => $acct_username,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'acct_limit' => $acct_limit,
                'limit_remain' => $limit_remain,
                'acct_email' => $acct_email,
                'acct_password' => password_hash((string)$acct_password, PASSWORD_BCRYPT),
                'acct_no'=>$acct_no,
                'ssn'=>$ssn,
                'acct_balance'=>$acct_balance,
                'avail_balance' => $avail_balance,
                'acct_type'=>$acct_type,
                'acct_gender'=>$acct_gender,
                'marital_status'=>$marital_status,
                'acct_currency'=>$acct_currency,
                'acct_phone'=>$acct_phone,
                'acct_occupation'=>$acct_occupation,
                'country'=>$country,
                'state'=>$state,
                'acct_address'=>$acct_address,
                'acct_dob'=>$acct_dob,
                'acct_cot'=>$acct_cot,
                'acct_imf'=>$acct_imf,
                'acct_tax'=>$acct_tax,
                'acct_pin'=>$acct_pin,
                // Account Manager Field
                'mgr_name' =>$mgr_name,
                'mgr_no' =>$mgr_no,
                'mgr_email' =>$mgr_email,
                'mgr_id' =>$mgr_id,
                'mgr_image' =>$mgr_image,
                
                
            ]);


            if(true){

               
                
                if ($acct_currency === 'USD') {
    $currency = "$";
} elseif ($acct_currency === 'Euro') {
    $currency = "€";
} elseif ($acct_currency === 'Yuan') {
    $currency = "¥";
} elseif ($acct_currency === 'GBP') {
    $currency = "£";
} elseif ($acct_currency === 'CAD') {
    $currency = "¢";
}

                $amount_balance = $acct_balance;
                $fullName = $firstname." ".$lastname;
                //EMAIL SENDING
                $email = $acct_email;
                $APP_NAME = $pageTitle;
                $APP_URL = APP_URL;
                $BANK_PHONE = $BANK_PHONE;
                $tran_status = "";
                $message = $sendMail->regMsg($currency,$amount_balance, $fullName,$acct_type,$acct_password, $APP_NAME,$APP_URL,$BANK_PHONE,$acct_no, $acct_pin);
                $subject = "Welcome $fullName - $APP_NAME";
                $email_message->send_mail($email, $message, $subject);

                $subject = "Admin User Register - $APP_NAME";
                $email_message->send_mail($email, $message, $subject);
            }


            if(true){
                toast_alert('success','Account Created Successfully','Approved');
            }else{
                toast_alert('error','Sorry something went wrong');
            }
        }

    }







}

?>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Register New Account</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="row">
                            <div class="col-lg-10 col-12 mx-auto">
                                <form method="post" autocomplete="off">
                                    
                                    <!--<div class="row">-->
                                    <!--    <div class="col-md-12">-->
                                    <!--        <div class="form-group mb-4">-->
                                    <!--            <label for="">Account Number</label>-->
                                    <!--            <input type="text"  name="acct_no" class="form-control"  placeholder="Account Number" required>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                        
                                    <!--</div>-->
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">First Name</label>
                                                <input type="text"  name="firstname" class="form-control" id="" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Last Name</label>
                                                <input type="text"  name="lastname" class="form-control" id="" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Account Balance</label>
                                                <input  type="text" name="acct_balance" class="form-control" id="" placeholder="Account Balance" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Pending Balance</label>
                                                <input type="text"  name="avail_balance" class="form-control"  placeholder="Pending Balance" required>

                                                <input type="text"  name="ssn" hidden>

                                                

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Account Type</label>
                                                <select  name="acct_type" class="form-control  basic" required>
                                                    <option selected="selected">Select Account Type</option>
                                                    <option value="Savings">Savings Account</option>
                                                    <option value="Current">Current Account</option>
                                                    <option value="Checkings">Checking Account</option>
                                                    <option value="Fixed Deposit">Fixed Deposit</option>
                                                    <option value="Non Resident">Non Resident Account</option>
                                                    <option value="Online Banking">Online Banking</option>
                                                    <option value="Domicilary Account">Domicilary Account</option>
                                                    <option value="Joint Account">Joint Account</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Account Gender</label>
                                                <select name="acct_gender"  class="form-control basic" required>
                                                    <option selected="selected">Select Gender</option>
                                                    <option value="female">Female</option>
                                                    <option value="male">Male</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Address</label>
                                                <input  name="acct_address" type="text" class="form-control" id="" placeholder="Address" >
                                                <input value="single" name="marital_status" type="text" class="form-control" id="" placeholder="Marital Status" hidden>
                                                <input value="500000" name="acct_limit" type="text" class="form-control" id="" placeholder="Marital Status" hidden>
                                                <input value="500000" name="limit_remain" type="text" class="form-control" id="" placeholder="Marital Status" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Account Currency</label>
                                                <select name="acct_currency" id="" class="form-control basic" required>
                                                    <option selected="selected">Account Currency</option>
                                                    <option value="USD">USD</option>
                                        <option value="Euro">Euro</option>
                                        <option value="Yuan">Yuan</option>
                                        <option value="GBP">GBP </option>
                                        <option value="CAD">CAD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Account Email</label>
                                                <input  type="email" class="form-control" id="rEmail" placeholder="Account Email" name="acct_email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Phone Number</label>
                                                <input  name="acct_phone" type="number" class="form-control" id="" placeholder="Phone Number" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Occupation</label>
                                                <input  name="acct_occupation" type="text" class="form-control" id="" placeholder="Occupation" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Date of Birth</label>
                                                <input  name="acct_dob" type="date" class="form-control" id="" placeholder="Date Of Birth" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Country</label>
                                                <select name="country" class="form-control  basic" >
                                                    <option selected="selected">Select Country</option>
                                                    <option value="Afganistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="American Samoa">American Samoa</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Anguilla">Anguilla</option>
                                                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bonaire">Bonaire</option>
                                                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Canary Islands">Canary Islands</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Channel Islands">Channel Islands</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Cocos Island">Cocos Island</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cote DIvoire">Cote DIvoire</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Curaco">Curacao</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czech Republic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="East Timor">East Timor</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Falkland Islands">Falkland Islands</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern Ter">French Southern Ter</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Great Britain">Great Britain</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Hawaii">Hawaii</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="India">India</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Korea North">Korea North</option>
                                                    <option value="Korea Sout">Korea South</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macau">Macau</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Midway Islands">Midway Islands</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Nambia">Nambia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherland Antilles">Netherland Antilles</option>
                                                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                                    <option value="Nevis">Nevis</option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau Island">Palau Island</option>
                                                    <option value="Palestine">Palestine</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Phillipines">Philippines</option>
                                                    <option value="Pitcairn Island">Pitcairn Island</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                    <option value="Republic of Serbia">Republic of Serbia</option>
                                                    <option value="Reunion">Reunion</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="St Barthelemy">St Barthelemy</option>
                                                    <option value="St Eustatius">St Eustatius</option>
                                                    <option value="St Helena">St Helena</option>
                                                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                    <option value="St Lucia">St Lucia</option>
                                                    <option value="St Maarten">St Maarten</option>
                                                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                                    <option value="Saipan">Saipan</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="Samoa American">Samoa American</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Tahiti">Tahiti</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                                    <option value="United States of America">United States of America</option>
                                                    <option value="Uraguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Vatican City State">Vatican City State</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                    <option value="Wake Island">Wake Island</option>
                                                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zaire">Zaire</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">State</label>
                                                <input  name="state" type="text" class="form-control" id="" placeholder="State">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <input name="acct_cot" type="text" class="form-control" placeholder="COT CODE" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="acct_imf" type="text" class="form-control"  placeholder="IMF CODE" >
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="acct_tax" type="text" class="form-control"  placeholder="TAX CODE" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="acct_pin" type="text" class="form-control"  placeholder="ACCT PIN: 1234" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Account Manager -->
                                    
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <input name="mgr_name" type="text" class="form-control" placeholder="Account Manager Name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="mgr_no" type="text" class="form-control"  placeholder="Account Manager Number" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <input name="mgr_email" type="text" class="form-control" placeholder="Account Manager Email" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="mgr_id" type="text" class="form-control"  placeholder="Account Manager ID" >
                                                <input type="text" class="form-control"  placeholder="account1.png" value="account1.png" name="mgr_image"  hidden/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    
                                    
                                    
                                    
                                    <!-- End Account Manager -->
                                    
                                    


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <input name="acct_password" type="password" class="form-control" id="rPassword" placeholder="Password *" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="confirm_password" type="password" class="form-control" id="rConfirmPassword" placeholder="Confirm Password *" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button name="register"  type="submit" class="btn btn-primary mt-3">Create User</button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        include_once("./layout/footer.php");
        ?>
