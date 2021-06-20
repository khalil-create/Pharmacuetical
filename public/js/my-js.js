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
        ee.hidden = true;
        if(phone_number.value >= 700000000 && phone_number.value <= 799999999){
            ee.hidden = true;
            phone_number.style.border = "1px solid #007bff";

        }
        else if(phone_number.value > 799999999){
            ee.textContent = "يجب ان لا يتجاوز العدد لأكثر من 9 ارقام";
            phone_number.style.border = "1px solid #dc3545";
            ee.hidden = false;
        }
        else{
            phone_number.style.border = "1px solid #dc3545";
            ee.textContent = "ادخل 7 ارقام";
            ee.hidden = false;
        }
    }
////////////////////////// end //////////////////////////////////////////////////////

///////////////////////// start //////////////////////////////////////////////////////

///////////////////////// end //////////////////////////////////////////////////////
