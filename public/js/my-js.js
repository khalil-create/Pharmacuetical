///////////////////////// start check password ///////////////////////////////////////////

function checkPassword()
{
    var password = document.getElementById("password");
    var password_confirmation = document.getElementById("password_confirmation");
    var masgError = document.getElementById("inalidPasswordConfirmation");

    if(password.value == password_confirmation.value)
    {
        masgError.hidden = true;
        password_confirmation.style.border = "1px solid #007bff";
    }
    else
    {
        masgError.hidden = false;
        password_confirmation.style.border = "1px solid #dc3545";
    }
}

///////////////////////// End check password /////////////////////////////////////////////

///////////////////////// start //////////////////////////////////////////////////////
function showList(){
    var usertype = document.getElementById("usertype").value;
    var existTeemLeader = document.getElementById("emptyTeemLeader").value;
    var existSupervisor = document.getElementById("emptySupervisor").value;
    if(usertype == 'مدير فريق')
    {
        document.getElementById("supervisor").hidden = false;
        document.getElementById("teemLeadersList").hidden = true;
    }
    else if(usertype == 'مندوب علمي')
    {
        // document.getElementById("supervisor").hidden = false;
        if(existTeemLeader == "NothingTeemLeader")
        {
            confirm("لايمكنك اضافة المندوب العلمي قبل مايتم اضافة على الأقل مدير فريق واحد");
            document.getElementById("usertype").value = "مدير فريق";
        }
        else
            document.getElementById("teemLeadersList").hidden = false;
    }
    else
    {
        document.getElementById("supervisor").hidden = true;
        document.getElementById("teemLeadersList").hidden = true;
        
    }
}
///////////////////////// end //////////////////////////////////////////////////////

///////////////////////// start //////////////////////////////////////////////////////
function showListInRep(){
    var usertype = document.getElementById("usertype").value;
    if(usertype == 'مدير فريق')
    {
        document.getElementById("teemLeadersList").hidden = true;
    }
    else if(usertype == 'مندوب علمي')
    {
        document.getElementById("teemLeadersList").hidden = false;
    }
    else
    {
        document.getElementById("teemLeadersList").hidden = true;        
    }
}
///////////////////////// end //////////////////////////////////////////////////////


///////////////////////// start //////////////////////////////////////////////////////
    var phone_number = document.getElementById("phonenumber");
    var ee = document.getElementById("invalidPhoneNo");
    phone_number.onkeyup = function()
    {
        let seven = phone_number.value;
        // $seven = Math.trunc($seven);
        let ss = num => Number(num);
        let intArr = Array.from(String(seven),ss);
        ee.hidden = true;
        if(phone_number.value >= 700000000 && phone_number.value <= 799999999){
            ee.hidden = true;
            phone_number.style.border = "1px solid #007bff";

        }
        else if(phone_number.value > 799999999){
            if(intArr[0] != 7)
                ee.textContent = "يجب ان يبدأ برقم 7";
            else
                ee.textContent = "يجب ان لا يتجاوز العدد لأكثر من 9 ارقام ";
            phone_number.style.border = "1px solid #dc3545";
            ee.hidden = false;
        }
        else{
            if(intArr[0] != 7)
                ee.textContent = "يجب ان يبدأ برقم 7";
            else
                ee.textContent = "ادخل 9 ارقام";
            phone_number.style.border = "1px solid #dc3545";
            ee.hidden = false;
        }
    }
////////////////////////// end //////////////////////////////////////////////////////

///////////////////////// start //////////////////////////////////////////////////////
    function checkAnswer()
    {
        var answer = document.getElementById("right_answer");
        var ch1 = document.getElementById("choice1");
        var ch2 = document.getElementById("choice2");
        var ch3 = document.getElementById("choice3");
        var ch4 = document.getElementById("choice4");
        var e = document.getElementById("error_answer");
        if(answer.value == ch1.value || answer.value == ch2.value || answer.value == ch3.value || answer.value == ch4.value)
        {
            if(answer.value == ch1.value){
                answer.style.border = "1px solid #007bff";
                answer.style.backgroundColor = "#3ed6a3";
                ch1.style.backgroundColor = "#3ed6a3";
                ch2.style.backgroundColor = "#fff";
                ch3.style.backgroundColor = "#fff";
                ch4.style.backgroundColor = "#fff";
                ch2.style.border = "1px solid #007bff";
                ch3.style.border = "1px solid #007bff";
                ch4.style.border = "1px solid #007bff";
            }
            else if(answer.value == ch2.value){
                answer.style.border = "1px solid #007bff";
                answer.style.backgroundColor = "#3ed6a3";
                ch2.style.backgroundColor = "#3ed6a3";
                ch1.style.backgroundColor = "#fff";
                ch3.style.backgroundColor = "#fff";
                ch4.style.backgroundColor = "#fff";
            }
            else if(answer.value == ch3.value){
                answer.style.border = "1px solid #007bff";
                answer.style.backgroundColor = "#3ed6a3";
                ch3.style.backgroundColor = "#3ed6a3";
                ch1.style.backgroundColor = "#fff";
                ch2.style.backgroundColor = "#fff";
                ch4.style.backgroundColor = "#fff";
            }
            else if(answer.value == ch4.value){
                answer.style.border = "1px solid #007bff";
                answer.style.backgroundColor = "#3ed6a3";
                ch4.style.backgroundColor = "#3ed6a3";
                ch1.style.backgroundColor = "#fff";
                ch2.style.backgroundColor = "#fff";
                ch3.style.backgroundColor = "#fff";
            }
            e.hidden = true;
        }
        else{
            e.hidden = false;
            answer.style.backgroundColor = "#fff";
            ch1.style.backgroundColor = "#fff";
            ch2.style.backgroundColor = "#fff";
            ch3.style.backgroundColor = "#fff";
            ch4.style.backgroundColor = "#fff";
            answer.style.border = "1px solid #dc3545";
        }
    }
///////////////////////// end //////////////////////////////////////////////////////

///////////////////////// start Tel_phone_doctor //////////////////////////////////////////////////////
    var clinic_phone = document.getElementById("Tel_phone");
    var messege = document.getElementById("invalidClinicNo");
    clinic_phone.onkeyup = function()
    {
        messege.hidden = true;
        if(clinic_phone.value >= 10000000 && clinic_phone.value <= 99999999){
            messege.hidden = true;
            clinic_phone.style.border = "1px solid #007bff";

        }
        else if(clinic_phone.value > 999999999){
            messege.textContent = "يجب ان لا يتجاوز العدد لأكثر من 8 ارقام";
            clinic_phone.style.border = "1px solid #dc3545";
            messege.hidden = false;
        }
        else{
            clinic_phone.style.border = "1px solid #dc3545";
            messege.textContent = "ادخل 8 ارقام";
            messege.hidden = false;
        }
    }
///////////////////////// end Tel_phone_doctor //////////////////////////////////////////////////////

///////////////////////// start phone_Owner //////////////////////////////////////////////////////
    Tel_phone_Owner = document.getElementById("Tel_phone_Owner");
    invalidOwnerNo = document.getElementById("invalidOwnerNo");
    // Tel_phone_Owner.onkeyup = function()
    function checkTelPhoneOwner()
    {
        console.log('lll');
        invalidOwnerNo.hidden = true;
        if(Tel_phone_Owner.value >= 10000000 && Tel_phone_Owner.value <= 99999999){
            invalidOwnerNo.hidden = true;
            Tel_phone_Owner.style.border = "1px solid #007bff";

        }
        else if(Tel_phone_Owner.value > 99999999){
            invalidOwnerNo.textContent = "يجب ان لا يتجاوز العدد لأكثر من 8 ارقام";
            Tel_phone_Owner.style.border = "1px solid #dc3545";
            invalidOwnerNo.hidden = false;
        }
        else{
            Tel_phone_Owner.style.border = "1px solid #dc3545";
            invalidOwnerNo.textContent = "ادخل 8 ارقام";
            invalidOwnerNo.hidden = false;
        }
    }
///////////////////////// end phone_Owner //////////////////////////////////////////////////////

///////////////////////// start phone_Contact //////////////////////////////////////////////////////
    Tel_phone_Contact = document.getElementById("Tel_phone_Contact");
    invalidContactPhone = document.getElementById("invalidContactPhone");
    // Tel_phone_Contact.onkeyup = function()
    function checkTelPhoneContact()
    {
        invalidContactPhone.hidden = true;
        if(Tel_phone_Contact.value >= 10000000 && Tel_phone_Contact.value <= 99999999){
            invalidContactPhone.hidden = true;
            Tel_phone_Contact.style.border = "1px solid #007bff";

        }
        else if(Tel_phone_Contact.value > 99999999){
            invalidContactPhone.textContent = "يجب ان لا يتجاوز العدد لأكثر من 8 ارقام";
            Tel_phone_Contact.style.border = "1px solid #dc3545";
            invalidContactPhone.hidden = false;
        }
        else{
            Tel_phone_Contact.style.border = "1px solid #dc3545";
            invalidContactPhone.textContent = "ادخل 8 ارقام";
            invalidContactPhone.hidden = false;
        }
    }
///////////////////////// end phone_Contact //////////////////////////////////////////////////////

///////////////////////// start //////////////////////////////////////////////////////
function checkTel()
{
    var TelPhone_Contact = document.getElementById("Tel_Contact");
    var invalidContactTel = document.getElementById("invalidContactTel");

    let seven = TelPhone_Contact.value;
    // $seven = Math.trunc($seven);
    let ss = num => Number(num);
    let intArr = Array.from(String(seven),ss);
    invalidContactTel.hidden = true;
    if(TelPhone_Contact.value >= 700000000 && TelPhone_Contact.value <= 799999999)
    {
        invalidContactTel.hidden = true;
        TelPhone_Contact.style.border = "1px solid #007bff";

    }
    else if(TelPhone_Contact.value > 799999999)
    {
        if(intArr[0] != 7)
        invalidContactTel.textContent = "يجب ان يبدأ برقم 7";
        else
            invalidContactTel.textContent = "يجب ان لا يتجاوز العدد لأكثر من 9 ارقام ";
        TelPhone_Contact.style.border = "1px solid #dc3545";
        invalidContactTel.hidden = false;
    }
    else{
        if(intArr[0] != 7)
            invalidContactTel.textContent = "يجب ان يبدأ برقم 7";
        else
            invalidContactTel.textContent = "ادخل 9 ارقام";
        TelPhone_Contact.style.border = "1px solid #dc3545";
        invalidContactTel.hidden = false;
    }
}
//////////////////////////// Start check service name /////////////////////////
service_type = document.getElementById("service_type");
service_name = document.getElementById("service_name");
function showServiceName(){
    s_name = document.getElementById("name");
    if(service_type.value == 1){
        service_name.hidden = false;
        s_name.value = '';
    }
    else{
        service_name.hidden = true;
        s_name.value = 'write service name';
    }
}

//////////////////////////// end check service name /////////////////////////

//////////////////////////// start check customer type /////////////////////////

function showCustType(){
    var cust_type = document.getElementById("cust_type").value;
    if(cust_type == 1)
    {
        document.getElementById("cust_name").hidden = true;
        document.getElementById("doctor_name").hidden = false;
    }
    else if(cust_type == 0)
    {
        document.getElementById("cust_name").hidden = false;
        document.getElementById("doctor_name").hidden = true;
    }
    else
    {
        document.getElementById("doctor_name").hidden = true; 
        document.getElementById("doctor_name").hidden = true;       
    }
}
//////////////////////////// end check customer type /////////////////////////
