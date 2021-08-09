//////////////////////////// start calculate count items /////////////////////////
count_items =  document.getElementById("count_items");
counter_items =  document.getElementById("counter_items");
if(count_items.textContent < 1){
    count_items.textContent = counter_items.value;
}
//////////////////////////// end calculate count items /////////////////////////

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
        if(clinic_phone.value >= 01000000 && clinic_phone.value <= 09999999){
            messege.hidden = true;
            clinic_phone.style.border = "1px solid #007bff";

        }
        else if(clinic_phone.value > 099999999){
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
        let number = Tel_phone_Owner.value;
        let ss = num => Number(num);
        let intArr = Array.from(String(number),ss);
        invalidOwnerNo.hidden = true;
        if(Tel_phone_Owner.value >= 01000000 && Tel_phone_Owner.value <= 09999999 && intArr[0] == 0){
            invalidOwnerNo.hidden = true;
            Tel_phone_Owner.style.border = "1px solid #007bff";
        }
        else if(Tel_phone_Owner.value > 099999999){
            if(intArr[0] != 0)
                invalidOwnerNo.textContent = "يجب ان يبدأ برقم 0";
            else
                invalidOwnerNo.textContent = "يجب ان لا يتجاوز العدد لأكثر من 8 ارقام";
            Tel_phone_Owner.style.border = "1px solid #dc3545";
            invalidOwnerNo.hidden = false;
        }
        else{
            if(intArr[0] != 0)
                invalidOwnerNo.textContent = "يجب ان يبدأ برقم 0";
            else
                invalidOwnerNo.textContent = "ادخل 8 ارقام";
            Tel_phone_Owner.style.border = "1px solid #dc3545";
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
        let number = Tel_phone_Contact.value;
        let ss = num => Number(num);
        let intArr = Array.from(String(number),ss);
        invalidContactPhone.hidden = true;
        if(Tel_phone_Contact.value >= 01000000 && Tel_phone_Contact.value <= 09999999 && intArr[0] == 0){
            invalidContactPhone.hidden = true;
            Tel_phone_Contact.style.border = "1px solid #007bff";

        }
        else if(Tel_phone_Contact.value > 09999999){
            if(intArr[0] != 0)
                invalidContactPhone.textContent = "يجب ان يبدأ الرقم بـ 0";
            else
                invalidContactPhone.textContent = "يجب ان لا يتجاوز العدد لأكثر من 8 ارقام";
            Tel_phone_Contact.style.border = "1px solid #dc3545";
            invalidContactPhone.hidden = false;
        }
        else{
            if(intArr[0] != 0)
                invalidContactPhone.textContent = "يجب ان يبدأ الرقم بـ0";
            else
                invalidContactPhone.textContent = "ادخل 8 ارقام";
            Tel_phone_Contact.style.border = "1px solid #dc3545";
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

//////////////////////////// start check visit type /////////////////////////

visit_type = document.getElementById("visit_type");
item = document.getElementById("item");
scientific_mission = document.getElementById("scientific_mission");
service_name = document.getElementById("service_name");
description = document.getElementById("description");
function checkVisitType(){
    desc = document.getElementById("desc");
    mission = document.getElementById("mission");
    if(visit_type.value == 1){
        item.hidden = false;
        scientific_mission.hidden = false;
        service_name.hidden = true;
        description.hidden = true;
        mission.value = '';
        desc.value = 'description';
    }
    else if(visit_type.value == 2){
        item.hidden = true;
        scientific_mission.hidden = true;
        service_name.hidden = false;
        description.hidden = true;
        mission.value = 'mission';
        desc.value = 'description';
    }
    else{
        item.hidden = true;
        scientific_mission.hidden = true;
        service_name.hidden = true;
        description.hidden = true;
        mission.value = 'mission';
        desc.value = '';
    }
}


//////////////////////////// end check visit type /////////////////////////


//////////////////////////// start check have items /////////////////////////
haveItem = document.getElementById("haveItem");
table = document.getElementById("table");
error = document.getElementById("error");
if(haveItem.value == 0){
    table.hidden = true;
    error.hidden = false;
}

//////////////////////////// end check have items /////////////////////////


//////////////////////////// start check points type for training courses /////////////////////////

function pointsType(){
    var points_type = document.getElementById("points_type");
    var link = document.getElementById("link");
    var file_points = document.getElementById("file_points");

    var imp_file = document.getElementById("imp_file");
    var imp_link = document.getElementById("imp_link");
    if(points_type.value == 1){
        file_points.hidden = false;
        link.hidden = true;
        imp_file.value = '';
        imp_link.value = 'link';
    }
    else if(points_type.value == 2){
        file_points.hidden = true;
        link.hidden = false;
        imp_link.value = '';
        imp_file.value = 'file';
    }
    else{
        file_points.hidden = true;
        link.hidden = true;
    }
}

//////////////////////////// end check points type for training courses /////////////////////////

//////////////////////////// start check validation completed all questions /////////////////////////
function Validation()
{
    var count = document.getElementById("count_q");
    var bol2 = $('form input[type=radio]:checked').length;
    if(bol2 < count.value){
        alert("لم يتم اكمال جميع الاسئلة الرجاء منك الاجابة على الاسئلة كامل");
        return false;
    }
}
//////////////////////////// end  check validation completed all questions /////////////////////////

//////////////////////////// start check validation distribute all sales objectives/////////////////////////
function ValidationDistributed()
{
    var inps = document.getElementsByName('objective[]');
    var total_objective = document.getElementById('total_objective');
    var sum = 0;
    for(var i =0; i<inps.length; i++){
        var inp = inps[i];
        sum = Number(sum) + Number(inps[i].value);
    }
    var total = total_objective.value;
    if(sum < total){
        swal({
            title: "خطأ!",
            text: "يجب ان يتم توزيع الهدف البيعي كامل....مقدار الاهداف الموزعة = "+sum+"/"+total+" = "+sum*100/total+"%",
            icon: "error",
            button: "حسناً!",
        });
        return false;
    }
    else if(sum > total){   
        swal({
            title: "خطأ!",
            text: "يجب ان يكون مجموع الاهداف البيعية تساوي الهدف البيعي المعطى ----- "+sum+" لايساوي "+total,
            icon: "error",
            button: "حسناً!",
        });
        return false;
    }
}
//////////////////////////// end  check validation distribute all sales objectives /////////////////////////

//////////////////////////// start check validation distribute all samples /////////////////////////
function ValidationCheckSample()
{
    var count_input = document.getElementsByName('count[]');
    var total = document.getElementById('count');
    var sum = 0;
    for(var i =0; i<count_input.length; i++){
        var inp = count_input[i];
        sum = Number(sum) + Number(count_input[i].value);
    }
    var total = total.value;
    if(sum > total){   
        swal({
            title: "خطأ ادخال!",
            text:'يجب ان يكون مجموع العينات الموزعة اقل او تساوي من كمية العينات المعطاه ----- '+sum+' > '+total,
            icon: "error",
            button: "حسناً!",
        });
        return false;
    }
}
//////////////////////////// end  check validation distribute all samples /////////////////////////

//////////////////////////// start check validation plan /////////////////////////
function checkPlan()
{
    var plan_month = document.getElementById('plan_month');
    var plan_type = document.getElementById('plan_type');
    if(plan_month.value == -1){   
        swal({
            title: "خطأ!",
            text: "يجب عليك اختيار شهر الخطة",
            icon: "error",
            button: "حسناً!",
        });
        return false;
    }
    if(plan_type.value == -1){   
        swal({
            title: "خطأ!",
            text: "يجب عليك اختيار نوع الخطة",
            icon: "error",
            button: "حسناً!",
        });
        return false;
    }
}
//////////////////////////// end  check validation plan /////////////////////////

//////////////////////////// start check plan data /////////////////////////
function checkDataPlan()
{
    var month_entered = document.getElementById('month_entered');
    var month_plan = document.getElementById('month_plan');
    const arr_date = month_entered.value.split("-",3);
    if(arr_date[1] != month_plan.value){
        swal({
            title: "خطأ!",
            text: "يجب ان يكون التأريخ في شهر "+month_plan.value,
            icon: "error",
            button: "حسناً!",
        });
        return false;
    }
}
//////////////////////////// end check plan data ///////////////////////////